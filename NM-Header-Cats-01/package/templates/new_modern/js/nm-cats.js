/**
 * New Modern: виджет «Категории».
 * 1. Аккордеоны: кнопка .nm-cats__toggle раскрывает ветку; data-nm-exclusive="1" — одна открытая ветка на уровне.
 * 2. Выпадающее меню: подменю открывается вправо, а если справа не хватает места (виджет у правого края
 *    окна), то влево. На экранах без наведения первое нажатие на пункт с подкатегориями открывает подменю,
 *    второе переходит по ссылке.
 * Без JS категории остаются обычными ссылками, выпадающее меню работает по наведению.
 */
(function () {
    'use strict';

    var NO_HOVER = window.matchMedia ? window.matchMedia('(hover: none)') : { matches: false };

    function closest(el, selector) {
        while (el && el.nodeType === 1) {
            var matches = el.matches || el.msMatchesSelector || el.webkitMatchesSelector;
            if (matches.call(el, selector)) { return el; }
            el = el.parentNode;
        }
        return null;
    }

    function child(el, tag) {
        for (var i = 0; i < el.children.length; i++) {
            if (el.children[i].tagName === tag) { return el.children[i]; }
        }
        return null;
    }

    function rowToggle(li) {
        var row = null;
        for (var i = 0; i < li.children.length; i++) {
            if (li.children[i].className.indexOf('nm-cats__row') !== -1) { row = li.children[i]; break; }
        }
        return row ? row.querySelector('.nm-cats__toggle') : null;
    }

    function setOpen(li, open) {
        li.classList.toggle('is-open', open);
        var toggle = rowToggle(li);
        if (toggle) { toggle.setAttribute('aria-expanded', open ? 'true' : 'false'); }
    }

    function closeSiblings(li) {
        var list = li.parentNode;
        if (!list) { return; }
        for (var i = 0; i < list.children.length; i++) {
            if (list.children[i] !== li && list.children[i].classList.contains('is-open')) {
                setOpen(list.children[i], false);
            }
        }
    }

    function openItem(li, root) {
        if (root && root.getAttribute('data-nm-exclusive') === '1') { closeSiblings(li); }
        setOpen(li, true);
    }

    // Направление выпадающего подменю: вправо, а при нехватке места справа влево
    function placeFly(li) {
        var sub = child(li, 'UL');
        if (!sub) { return; }

        var parent = closest(li.parentNode, '.nm-cats__item');
        var vw     = document.documentElement.clientWidth;
        var rect   = li.getBoundingClientRect();
        var width  = sub.offsetWidth || 240;
        var spaceRight = vw - rect.right;
        var spaceLeft  = rect.left;

        var left = spaceRight < width && spaceLeft > spaceRight;

        // Вложенное подменю продолжает направление родителя, если слева хватает места
        if (!left && parent && parent.classList.contains('nm-fly-left') && spaceLeft >= width) { left = true; }

        li.classList.toggle('nm-fly-left', left);
    }

    function onHover(e) {
        var li = closest(e.target, '.nm-cats--fly .nm-cats__item.has-sub');
        if (li) { placeFly(li); }
    }

    document.addEventListener('mouseover', onHover, true);
    document.addEventListener('focusin', onHover, true);

    document.addEventListener('click', function (e) {

        var toggle = closest(e.target, '.nm-cats__toggle');

        if (toggle) {
            var li   = closest(toggle, '.nm-cats__item');
            var root = closest(li, '.nm-cats');
            if (li.classList.contains('is-open')) { setOpen(li, false); } else { openItem(li, root); }
            e.preventDefault();
            return;
        }

        // Экраны без наведения: первое нажатие открывает подменю
        var link = closest(e.target, '.nm-cats--fly .nm-cats__link');

        if (link && (NO_HOVER.matches || window.innerWidth < 768)) {
            var item = closest(link, '.nm-cats__item');
            if (item && item.classList.contains('has-sub') && !item.classList.contains('is-open')) {
                e.preventDefault();
                placeFly(item);
                openItem(item, closest(item, '.nm-cats'));
                return;
            }
        }

        // Нажатие вне выпадающего меню закрывает открытые подменю
        if (!closest(e.target, '.nm-cats--fly')) {
            var open = document.querySelectorAll('.nm-cats--fly .nm-cats__item.is-open');
            for (var i = 0; i < open.length; i++) { setOpen(open[i], false); }
        }
    });
})();
