//fgnass.github.com/spin.js#v2.0.0
! function(a, b) {
    "object" == typeof exports ? module.exports = b() : "function" == typeof define && define.amd ? define(b) : a.Spinner = b()
}(this, function() {
    "use strict";

    function a(a, b) {
        var c, d = document.createElement(a || "div");
        for (c in b) d[c] = b[c];
        return d
    }

    function b(a) {
        for (var b = 1, c = arguments.length; c > b; b++) a.appendChild(arguments[b]);
        return a
    }

    function c(a, b, c, d) {
        var e = ["opacity", b, ~~ (100 * a), c, d].join("-"),
            f = .01 + c / d * 100,
            g = Math.max(1 - (1 - a) / b * (100 - f), a),
            h = j.substring(0, j.indexOf("Animation")).toLowerCase(),
            i = h && "-" + h + "-" || "";
        return l[e] || (m.insertRule("@" + i + "keyframes " + e + "{0%{opacity:" + g + "}" + f + "%{opacity:" + a + "}" + (f + .01) + "%{opacity:1}" + (f + b) % 100 + "%{opacity:" + a + "}100%{opacity:" + g + "}}", m.cssRules.length), l[e] = 1), e
    }

    function d(a, b) {
        var c, d, e = a.style;
        for (b = b.charAt(0).toUpperCase() + b.slice(1), d = 0; d < k.length; d++)
            if (c = k[d] + b, void 0 !== e[c]) return c;
        return void 0 !== e[b] ? b : void 0
    }

    function e(a, b) {
        for (var c in b) a.style[d(a, c) || c] = b[c];
        return a
    }

    function f(a) {
        for (var b = 1; b < arguments.length; b++) {
            var c = arguments[b];
            for (var d in c) void 0 === a[d] && (a[d] = c[d])
        }
        return a
    }

    function g(a, b) {
        return "string" == typeof a ? a : a[b % a.length]
    }

    function h(a) {
        this.opts = f(a || {}, h.defaults, n)
    }

    function i() {
        function c(b, c) {
            return a("<" + b + ' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">', c)
        }
        m.addRule(".spin-vml", "behavior:url(#default#VML)"), h.prototype.lines = function(a, d) {
            function f() {
                return e(c("group", {
                    coordsize: k + " " + k,
                    coordorigin: -j + " " + -j
                }), {
                    width: k,
                    height: k
                })
            }

            function h(a, h, i) {
                b(m, b(e(f(), {
                    rotation: 360 / d.lines * a + "deg",
                    left: ~~h
                }), b(e(c("roundrect", {
                    arcsize: d.corners
                }), {
                    width: j,
                    height: d.width,
                    left: d.radius,
                    top: -d.width >> 1,
                    filter: i
                }), c("fill", {
                    color: g(d.color, a),
                    opacity: d.opacity
                }), c("stroke", {
                    opacity: 0
                }))))
            }
            var i, j = d.length + d.width,
                k = 2 * j,
                l = 2 * -(d.width + d.length) + "px",
                m = e(f(), {
                    position: "absolute",
                    top: l,
                    left: l
                });
            if (d.shadow)
                for (i = 1; i <= d.lines; i++) h(i, -2, "progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)");
            for (i = 1; i <= d.lines; i++) h(i);
            return b(a, m)
        }, h.prototype.opacity = function(a, b, c, d) {
            var e = a.firstChild;
            d = d.shadow && d.lines || 0, e && b + d < e.childNodes.length && (e = e.childNodes[b + d], e = e && e.firstChild, e = e && e.firstChild, e && (e.opacity = c))
        }
    }
    var j, k = ["webkit", "Moz", "ms", "O"],
        l = {}, m = function() {
            var c = a("style", {
                type: "text/css"
            });
            return b(document.getElementsByTagName("head")[0], c), c.sheet || c.styleSheet
        }(),
        n = {
            lines: 12,
            length: 7,
            width: 5,
            radius: 10,
            rotate: 0,
            corners: 1,
            color: "#000",
            direction: 1,
            speed: 1,
            trail: 100,
            opacity: .25,
            fps: 20,
            zIndex: 2e9,
            className: "spinner",
            top: "50%",
            left: "50%",
            position: "absolute"
        };
    h.defaults = {}, f(h.prototype, {
        spin: function(b) {
            this.stop(); {
                var c = this,
                    d = c.opts,
                    f = c.el = e(a(0, {
                        className: d.className
                    }), {
                        position: d.position,
                        width: 0,
                        zIndex: d.zIndex
                    });
                d.radius + d.length + d.width
            }
            if (b && (b.insertBefore(f, b.firstChild || null), e(f, {
                left: d.left,
                top: d.top
            })), f.setAttribute("role", "progressbar"), c.lines(f, c.opts), !j) {
                var g, h = 0,
                    i = (d.lines - 1) * (1 - d.direction) / 2,
                    k = d.fps,
                    l = k / d.speed,
                    m = (1 - d.opacity) / (l * d.trail / 100),
                    n = l / d.lines;
                ! function o() {
                    h++;
                    for (var a = 0; a < d.lines; a++) g = Math.max(1 - (h + (d.lines - a) * n) % l * m, d.opacity), c.opacity(f, a * d.direction + i, g, d);
                    c.timeout = c.el && setTimeout(o, ~~ (1e3 / k))
                }()
            }
            return c
        },
        stop: function() {
            var a = this.el;
            return a && (clearTimeout(this.timeout), a.parentNode && a.parentNode.removeChild(a), this.el = void 0), this
        },
        lines: function(d, f) {
            function h(b, c) {
                return e(a(), {
                    position: "absolute",
                    width: f.length + f.width + "px",
                    height: f.width + "px",
                    background: b,
                    boxShadow: c,
                    transformOrigin: "left",
                    transform: "rotate(" + ~~(360 / f.lines * k + f.rotate) + "deg) translate(" + f.radius + "px,0)",
                    borderRadius: (f.corners * f.width >> 1) + "px"
                })
            }
            for (var i, k = 0, l = (f.lines - 1) * (1 - f.direction) / 2; k < f.lines; k++) i = e(a(), {
                position: "absolute",
                top: 1 + ~(f.width / 2) + "px",
                transform: f.hwaccel ? "translate3d(0,0,0)" : "",
                opacity: f.opacity,
                animation: j && c(f.opacity, f.trail, l + k * f.direction, f.lines) + " " + 1 / f.speed + "s linear infinite"
            }), f.shadow && b(i, e(h("#000", "0 0 4px #000"), {
                top: "2px"
            })), b(d, b(i, h(g(f.color, k), "0 0 1px rgba(0,0,0,.1)")));
            return d
        },
        opacity: function(a, b, c) {
            b < a.childNodes.length && (a.childNodes[b].style.opacity = c)
        }
    });
    var o = e(a("group"), {
        behavior: "url(#default#VML)"
    });
    return !d(o, "transform") && o.adj ? i() : j = d(o, "animation"), h
});
(function($) {
    var g, i = !0,
        r = !1,
        m = window.location,
        h = Array.prototype.slice,
        b = m.href.match(/^((https?:\/\/.*?\/)?[^#]*)#?.*$/),
        u = b[1] + "#",
        t = b[2],
        e, l, f, q, c, j, x = "elemUrlAttr",
        k = "href",
        y = "src",
        p = "urlInternal",
        d = "urlExternal",
        n = "urlFragment",
        a, s = {};

    function w(A) {
        var z = h.call(arguments, 1);
        return function() {
            return A.apply(this, z.concat(h.call(arguments)))
        }
    }
    $.isUrlInternal = q = function(z) {
        if (!z || j(z)) {
            return g
        }
        if (a.test(z)) {
            return i
        }
        if (/^(?:https?:)?\/\//i.test(z)) {
            return r
        }
        if (/^[a-z\d.-]+:/i.test(z)) {
            return g
        }
        return i
    };
    $.isUrlExternal = c = function(z) {
        var A = q(z);
        return typeof A === "boolean" ? !A : A
    };
    $.isUrlFragment = j = function(z) {
        var A = (z || "").match(/^([^#]?)([^#]*#).*$/);
        return !!A && (A[2] === "#" || z.indexOf(u) === 0 || (A[1] === "/" ? t + A[2] === u : !/^https?:\/\//i.test(z) && $('<a href="' + z + '"/>')[0].href.indexOf(u) === 0))
    };

    function v(A, z) {
        return this.filter(":" + A + (z ? "(" + z + ")" : ""))
    }
    $.fn[p] = w(v, p);
    $.fn[d] = w(v, d);
    $.fn[n] = w(v, n);

    function o(D, C, B, A) {
        var z = A[3] || e()[(C.nodeName || "").toLowerCase()] || "";
        return z ? !! D(C.getAttribute(z)) : r
    }
    $.expr[":"][p] = w(o, q);
    $.expr[":"][d] = w(o, c);
    $.expr[":"][n] = w(o, j);
    $[x] || ($[x] = function(z) {
        return $.extend(s, z)
    })({
        a: k,
        base: k,
        iframe: y,
        img: y,
        input: y,
        form: "action",
        link: k,
        script: y
    });
    e = $[x];
    $.urlInternalHost = l = function(B) {
        B = B ? "(?:(?:" + Array.prototype.join.call(arguments, "|") + ")\\.)?" : "";
        var A = new RegExp("^" + B + "(.*)", "i"),
            z = "^(?:" + m.protocol + ")?//" + m.hostname.replace(A, B + "$1").replace(/\\?\./g, "\\.") + (m.port ? ":" + m.port : "") + "/";
        return f(z)
    };
    $.urlInternalRegExp = f = function(z) {
        if (z) {
            a = typeof z === "string" ? new RegExp(z, "i") : z
        }
        return a
    };
    l("www")
})(jQuery);
/**
 * AJAX Navigation Block
 * http://theaveragedev.com
 *
 * Copyright (c) 2014 theAverageDev (Luca Tumedei)
 * Licensed under the GPLv2+ license.
 */

jQuery(document).ready(function($) {
    // create a default options object
    var defaults = {
        loadFromSelector: '.block-type-content .block-content',
        loadToSelector: '.block-type-content'
    }, menu = $('.menu-ajax');
    // bootstrap the plugin on the block 
    menu.each(function() {
        var $this = $(this),
            id = $this.data('block-id'),
            options;
        // grab the specific options object
        options = window['ajaxNavMenuOptions' + id];
        if (!options) {
            options = defaults;
        } else {
            options = $.extend(defaults, options);
        }
        // bootstrap the ajaxifySubmit plugin for this searchform
        $this.ajaxify(options);
    });
});