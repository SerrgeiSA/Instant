/**
 * New Modern: «Загрузить ещё» и автоподгрузка списков контента.
 *
 * Разметка (см. assets/nm_list.tpl.php):
 *  [data-nm-list="id"]            — список, внутри [data-nm-items] — контейнер записей
 *  .nm-more[data-nm-more="id"]    — кнопка; data-mode: button | auto | auto_button
 *  [data-nm-pagebar="id"]         — номера страниц (обновляются после подгрузки)
 *
 * Следующая страница запрашивается обычным URL списка (с фильтрами и сортировкой),
 * поэтому подгрузка работает в категориях, наборах, фильтрах и без JS (кнопка — ссылка).
 * После вставки записей на document отправляется событие «nm:list:loaded».
 */
(function () {
    'use strict';

    function itemsBox(list) {
        return list.querySelector('[data-nm-items]') || list;
    }

    function parse(html) {
        return new DOMParser().parseFromString(html, 'text/html');
    }

    function request(url, ajax) {
        var headers = ajax ? { 'X-Requested-With': 'XMLHttpRequest' } : {};
        return fetch(url, { credentials: 'same-origin', headers: headers }).then(function (r) {
            if (!r.ok) { throw new Error('HTTP ' + r.status); }
            return r.text();
        });
    }

    function NmMore(el) {
        this.el = el;
        this.id = el.getAttribute('data-nm-more');
        this.mode = el.getAttribute('data-mode') || 'button';
        this.autoPages = parseInt(el.getAttribute('data-auto-pages'), 10) || 3;
        this.loaded = 0;
        this.busy = false;
        this.btn = el.querySelector('.nm-more__btn');
        this.list = document.querySelector('[data-nm-list="' + this.id + '"]');
        if (!this.list || !this.btn) { return; }
        this.bind();
    }

    NmMore.prototype.bind = function () {
        var self = this;
        this.btn.addEventListener('click', function (e) {
            e.preventDefault();
            self.load();
        });
        if (this.mode !== 'button' && 'IntersectionObserver' in window) {
            this.el.classList.add('nm-more--auto');
            this.observer = new IntersectionObserver(function (entries) {
                if (entries[0].isIntersecting) { self.load(); }
            }, { rootMargin: '600px 0px' });
            this.observer.observe(this.el);
        }
    };

    NmMore.prototype.stopAuto = function () {
        if (this.observer) { this.observer.disconnect(); this.observer = null; }
        this.el.classList.remove('nm-more--auto');
    };

    NmMore.prototype.load = function () {
        if (this.busy) { return; }
        var url = this.el.getAttribute('data-next');
        if (!url) { return; }
        var self = this;
        this.busy = true;
        this.el.classList.add('is-loading');
        this.el.classList.remove('is-error');

        request(url, true).then(function (html) {
            var doc = parse(html);
            if (!doc.querySelector('[data-nm-list="' + self.id + '"]')) {
                // AJAX-ответ без списка (кэш, другой контроллер) — берём полную страницу
                return request(url, false).then(parse);
            }
            return doc;
        }).then(function (doc) {
            self.insert(doc, url);
        }).catch(function () {
            self.el.classList.add('is-error');
            self.stopAuto();
        }).then(function () {
            self.busy = false;
            self.el.classList.remove('is-loading');
        });
    };

    NmMore.prototype.insert = function (doc, url) {

        var remote = doc.querySelector('[data-nm-list="' + this.id + '"]');
        if (!remote) { throw new Error('no list'); }

        var box = itemsBox(this.list);
        var nodes = Array.prototype.slice.call(itemsBox(remote).children);

        // Ленты с группировкой по дням: не повторяем заголовок того же дня
        var days = box.querySelectorAll('[data-nm-day]');
        var lastDay = days.length ? days[days.length - 1].getAttribute('data-nm-day') : null;

        var fragment = document.createDocumentFragment();
        var first = null;
        nodes.forEach(function (node) {
            if (lastDay && node.hasAttribute('data-nm-day-head') && node.getAttribute('data-nm-day') === lastDay) {
                return;
            }
            node.classList.add('nm-appear');
            if (!first) { first = node; }
            fragment.appendChild(node);
        });
        box.appendChild(fragment);

        // Кнопка и номера страниц из загруженной страницы
        var remoteMore = doc.querySelector('[data-nm-more="' + this.id + '"]');
        var pagebar = document.querySelector('[data-nm-pagebar="' + this.id + '"]');
        var remotePagebar = doc.querySelector('[data-nm-pagebar="' + this.id + '"]');
        if (pagebar && remotePagebar) { pagebar.innerHTML = remotePagebar.innerHTML; }

        this.loaded++;

        if (remoteMore) {
            this.el.setAttribute('data-next', remoteMore.getAttribute('data-next'));
            this.el.setAttribute('data-page', remoteMore.getAttribute('data-page'));
            this.btn.setAttribute('href', remoteMore.getAttribute('data-next'));
            var shown = this.el.querySelector('.nm-more__shown');
            var remoteShown = remoteMore.querySelector('.nm-more__shown');
            if (shown && remoteShown) { shown.textContent = remoteShown.textContent; }
            if (this.mode === 'auto_button' && this.loaded >= this.autoPages) { this.stopAuto(); }
            // Кнопка могла остаться в зоне видимости — перезапускаем наблюдение
            if (this.observer) {
                var obs = this.observer, el = this.el;
                obs.unobserve(el);
                requestAnimationFrame(function () { obs.observe(el); });
            }
        } else {
            this.stopAuto();
            this.el.parentNode.removeChild(this.el);
        }

        document.dispatchEvent(new CustomEvent('nm:list:loaded', {
            detail: { id: this.id, url: url, list: this.list, first: first }
        }));

        // Совместимость с jQuery-обработчиками InstantCMS (модальные окна, рейтинг и т.п.)
        if (window.jQuery) { window.jQuery(document).trigger('nm:list:loaded', [this.list, url]); }
    };

    function init(root) {
        (root || document).querySelectorAll('.nm-more[data-nm-more]').forEach(function (el) {
            if (!el.nmMore) { el.nmMore = new NmMore(el); }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () { init(); });
    } else {
        init();
    }

    window.nmList = { init: init };
})();
