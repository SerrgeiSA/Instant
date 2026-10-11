if (!Object.assign) {
  Object.defineProperty(Object, 'assign', {
    enumerable: false,
    configurable: true,
    writable: true,
    value: function(target, firstSource) {
      'use strict';
      if (target === undefined || target === null) {
        throw new TypeError('Cannot convert first argument to object');
      }

      var to = Object(target);
      for (var i = 1; i < arguments.length; i++) {
        var nextSource = arguments[i];
        if (nextSource === undefined || nextSource === null) {
          continue;
        }

        var keysArray = Object.keys(Object(nextSource));
        for (var nextIndex = 0, len = keysArray.length; nextIndex < len; nextIndex++) {
          var nextKey = keysArray[nextIndex];
          var desc = Object.getOwnPropertyDescriptor(nextSource, nextKey);
          if (desc !== undefined && desc.enumerable) {
            to[nextKey] = nextSource[nextKey];
          }
        }
      }
      return to;
    }
  });
}

function NmThumbsEdit (maxWidth, margin) {
    this.margin = margin;
    this.containerWidth = maxWidth;
    this.containerHeight = Math.round(maxWidth * NmThumbsEdit.HEIGHT_RATIO);
};

NmThumbsEdit.prototype.processThumbs = function (thumbs) {
    var self = this;
    var items = [];
    var count = thumbs.length;
    var ratios = [];
    var letterRatios = '';

    thumbs.forEach(function (thumb) {
        var ratio = self.getRatio(thumb);
        letterRatios += ratio > 1.2 ? "w" : (ratio < 0.8 ? "n" : "q");
        ratios.push(ratio);
    });

    var averageRatio = ratios.length ? this.amountRatios(ratios) / ratios.length : 1;
    var containerRatio = this.containerWidth / this.containerHeight;

    if (count == 1) {
        var thumbRatio = ratios[0];
        var thumbWidth = 0;
        var thumbHeight = 0;

        if (thumbRatio >= containerRatio) {
            thumbWidth = this.containerWidth;
            thumbHeight = Math.min(thumbWidth / thumbRatio, this.containerHeight);
            this.containerHeight = thumbHeight;
        } else {
            thumbHeight = this.containerHeight;
            thumbWidth = Math.min(thumbHeight * thumbRatio, this.containerWidth);
            this.containerWidth = thumbWidth;
        }

        items.push(Object.assign({}, thumbs[0], {
            width: thumbWidth,
            height: thumbHeight,
            single: true,
            lastRow: true,
            lastColumn: true
        }));
    } else if (count == 2) {
        switch (letterRatios) {
            case "ww": {
                if (averageRatio >= 1.4 * containerRatio && ratios[1] - ratios[0] < 0.2) {
                    var thumbWidth  = this.containerWidth;
                    var thumbHeight = Math.min(thumbWidth / ratios[0], thumbWidth / ratios[1], (this.containerHeight - this.margin) / 2);

                    for (var i = 0; i < count; i++) {
                        items.push(Object.assign({}, thumbs[i], {
                            width: thumbWidth,
                            height: thumbHeight,
                            lastRow: i === 1,
                            lastColumn: true
                        }));
                    }

                    this.containerHeight = 2 * thumbHeight + this.margin;
                    break;
                }
            }

            case "nn":
            case "qn":
            case "nq":
            case "qq": {
                var thumbWidth  = Math.floor((this.containerWidth - this.margin) / 2);
                var thumbHeight = Math.min(thumbWidth / ratios[0], thumbWidth / ratios[1], this.containerHeight);

                for (var i = 0; i < count; i++) {
                    items.push(Object.assign({}, thumbs[i], {
                        width: thumbWidth,
                        height: thumbHeight,
                        lastRow: true,
                        lastColumn: i === 1
                    }));
                }

                this.containerHeight = thumbHeight;
                break;
            }

            default: {
                var thumbWidth = [];

                thumbWidth[0] = Math.floor((this.containerWidth - this.margin) / ratios[1] / (1 / ratios[0] + 1 / ratios[1]));
                thumbWidth[1] = this.containerWidth - thumbWidth[0] - this.margin;

                let thumbHeight = Math.min(this.containerHeight, thumbWidth[0] / ratios[0], thumbWidth[1] / ratios[1]);

                for (let i = 0; i < count; i++) {
                    items.push(Object.assign({}, thumbs[i], {
                        width: thumbWidth[i],
                        height: thumbHeight,
                        lastRow: true,
                        lastColumn: i === 1
                    }));
                }

                this.containerHeight = thumbHeight;
            }
        }
    } else if (count == 3) {
        if ((ratios[0] > 1.2 * containerRatio || averageRatio > 1.5 * containerRatio) && letterRatios == "www") {
            var thumbWidth = [], thumbHeight = [];

            thumbWidth[0]  = this.containerWidth;
            thumbHeight[0] = Math.min(thumbWidth[0] / ratios[0], 0.66 * (this.containerHeight - this.margin));

            if (letterRatios == "www") {
                thumbWidth[1] = thumbWidth[2] = (this.containerWidth - this.margin) / 2;
                thumbHeight[1] = thumbHeight[2] = Math.min(this.containerHeight - thumbHeight[0] - this.margin, thumbWidth[1] / ratios[1], thumbWidth[2] / ratios[2]);
            } else {
                thumbWidth[1] = (this.containerWidth - this.margin) / ratios[2] / (1 / ratios[1] + 1 / ratios[2]);
                thumbWidth[2] = this.containerWidth - thumbWidth[1] - this.margin;
                thumbHeight[1] = thumbHeight[2] = Math.min(this.containerHeight - thumbHeight[0] - this.margin, thumbWidth[2] / ratios[2], thumbWidth[1] / ratios[1])
            }

            for (var i = 0; i < count; i++) {
                items.push(Object.assign({}, thumbs[i], {
                    width: thumbWidth[i],
                    height: thumbHeight[i],
                    lastRow: i !== 0,
                    lastColumn: i !== 1
                }));
            }

            this.containerHeight = thumbHeight[0] + thumbHeight[1] + this.margin;
        } else {
            var thumbWidth = [], thumbHeight = [];

            thumbHeight[0] = this.containerHeight;
            thumbWidth[0]  = Math.min(thumbHeight[0] * ratios[0], 0.75 * (this.containerWidth - this.margin));

            thumbHeight[1] = ratios[1] * (this.containerHeight - this.margin) / (ratios[2] + ratios[1]);
            thumbHeight[2] = this.containerHeight - thumbHeight[1] - this.margin;
            thumbWidth[1]  = thumbWidth[2] = Math.min(this.containerWidth - thumbWidth[0] - this.margin, thumbHeight[2] * ratios[2], thumbHeight[1] * ratios[1]);

            for (var i = 0; i < count; i++) {
                items.push(Object.assign({}, thumbs[i], {
                    width: thumbWidth[i],
                    height: thumbHeight[i],
                    lastRow: i !== 1,
                    lastColumn: i !== 0
                }));
            }

            this.containerHeight = thumbHeight[0];
            this.containerWidth  = thumbWidth[0] + thumbWidth[1] + this.margin;
        }
    } else if (count == 4) {
        if ((ratios[0] > 1.2 * containerRatio || averageRatio > 1.5 * containerRatio) && letterRatios == "wwww" ) {
            var thumbWidth = [], thumbHeight = [];

            thumbWidth[0]  = this.containerWidth;
            thumbHeight[0] = Math.min(thumbWidth[0] / ratios[0], 0.66 * (this.containerHeight - this.margin));

            var height = (this.containerWidth - 2 * this.margin) / (ratios[1] + ratios[2] + ratios[3]);

            thumbWidth[1] = height * ratios[1];
            thumbWidth[2] = height * ratios[2];
            thumbWidth[3] = height * ratios[3];

            height = Math.min(this.containerHeight - thumbHeight[0] - this.margin, height);

            thumbHeight[1] = thumbHeight[2] = thumbHeight[3] = height;

            for (var i = 0; i < count; i++) {
                items.push(Object.assign({}, thumbs[i], {
                    width: thumbWidth[i],
                    height: thumbHeight[i],
                    lastRow: i !== 0,
                    lastColumn: i === 0 || i === 3
                }));
            }

            this.containerHeight = thumbHeight[0] + height + this.margin;
        } else {
            var thumbWidth = [], thumbHeight = [];

            thumbHeight[0] = this.containerHeight;
            thumbWidth[0]  = Math.min(thumbHeight[0] * ratios[0], 0.66 * (this.containerWidth - this.margin));

            var width = (this.containerHeight - 2 * this.margin) / (1 / ratios[1] + 1 / ratios[2] + 1 / ratios[3]);

            thumbHeight[1] = width / ratios[1];
            thumbHeight[2] = width / ratios[2];
            thumbHeight[3] = width / ratios[3];

            width = Math.min(this.containerWidth - thumbWidth[0] - this.margin, width);

            thumbWidth[1] = thumbWidth[2] = thumbWidth[3] = width;

            for (var i = 0; i < count; i++) {
                items.push(Object.assign({}, thumbs[i], {
                    width: thumbWidth[i],
                    height: thumbHeight[i],
                    lastRow: i === 0 || i === 3,
                    lastColumn: i !== 0
                }));
            }

            this.containerWidth = thumbWidth[0] + width + this.margin;
        }
    } else {
        var ratios_cropped = [];

        for (var i = 0; i < ratios.length; i++) {
            ratios_cropped.push(Math[averageRatio > 1.1 ? "max" : "min"](1, ratios[i]));
        }

        var tries = [];
        var first_line = 0;
        var second_line = 0;

        tries['' + count + ''] = [
            this.calculateMultiThumbsHeight(ratios_cropped, this.containerWidth, this.margin)
        ];

        for (first_line = 1; first_line <= count - 1; first_line++) {
            var key = first_line + ',' + (second_line = (count - first_line));
            tries[key] = [
                this.calculateMultiThumbsHeight(ratios_cropped.slice(0, first_line), this.containerWidth, this.margin),
                this.calculateMultiThumbsHeight(ratios_cropped.slice(first_line), this.containerWidth, this.margin)
            ];
        }

        for (first_line = 1; first_line <= count - 2; first_line++) {
            for (second_line = 1; second_line <= count - first_line - 1; second_line++) {
                var key = first_line + ',' + second_line + ',' + (count - first_line - second_line);
                tries[key] = [
                    this.calculateMultiThumbsHeight(ratios_cropped.slice(0, first_line), this.containerWidth, this.margin),
                    this.calculateMultiThumbsHeight(ratios_cropped.slice(first_line, first_line + second_line), this.containerWidth, this.margin),
                    this.calculateMultiThumbsHeight(ratios_cropped.slice(first_line + second_line), this.containerWidth, this.margin)
                ];
            }
        }

        var opt_conf = null;
        var opt_diff = 0;
        var opt_h = 0;

        for (var key in tries) {
            var heights = tries[key];
            var conf_h = this.amountRatios(heights) + this.margin * (heights.length - 1);
            var conf_diff = Math.abs(conf_h - this.containerHeight);

            if (key.indexOf(",") !== -1) {
                var conf_nums = key.split(",").map(function (e) {
                    return parseInt(e, 10);
                });

                if (conf_nums[0] > conf_nums[1] || conf_nums.length === 3 && conf_nums[1] > conf_nums[2]) {
                    conf_diff += 50;
                    conf_diff *= 1.5;
                }

                // TODO
                if (Math.min.apply(Math, conf_nums) < 1) {
                    conf_diff += 100;
                    conf_diff *= 3;
                }
            }

            if (opt_conf === null || conf_diff < opt_diff) {
                opt_conf = key;
                opt_diff = conf_diff;
                opt_h = conf_h;
            }
        }

        this.containerHeight = opt_h;

        var _thumbs = [].concat(thumbs);
        var n_ratios = [].concat(ratios_cropped);
        var chunks = opt_conf.split(",");
        var opt_heights = tries[opt_conf];
        var lastRow = chunks.length - 1;

        for (var i = 0; i < chunks.length; i++) {
            var line_chunks_num = parseInt(chunks[i], 10);
            var line_thumbs = _thumbs.splice(0, line_chunks_num);
            var thumbHeight = opt_heights.shift();
            var lastColumn = line_thumbs.length - 1;
            var amount_width = 0;

            for (var j = 0; j < line_thumbs.length; j++) {
                var thumb = line_thumbs[j];
                var ratio = n_ratios.shift();
                var thumbWidth = Math.round(ratio * thumbHeight);

                if (j == lastColumn) {
                    thumbWidth = this.containerWidth - amount_width;
                } else {
                    amount_width += thumbWidth + this.margin;
                }

                items.push(Object.assign({}, thumb, {
                    width: thumbWidth,
                    height: thumbHeight,
                    lastRow: lastRow == i,
                    lastColumn: lastColumn == j
                }));
            }
        }
    }

    return {
        width: Math.round(this.containerWidth),
        height: Math.round(this.containerHeight),
        items: items
    }
}

NmThumbsEdit.prototype.amountRatios = function (ratios) {
    var amount = 0;
    ratios.forEach(function (ratio) {
        amount += ratio;
    });
    return amount;
}

NmThumbsEdit.prototype.getRatio = function (thumb) {
    return thumb.width / thumb.height;
}

NmThumbsEdit.prototype.calculateMultiThumbsHeight = function (ratios, width, margin) {
    return Math.round((width - (ratios.length - 1) * margin) / this.amountRatios(ratios));
}

NmThumbsEdit.HEIGHT_RATIO = 0.86;