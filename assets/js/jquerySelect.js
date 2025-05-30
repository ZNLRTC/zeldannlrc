/*!
   Copyright 2015-2021 SpryMedia Ltd.

 This source file is free software, available under the following license:
   MIT license - http://datatables.net/license/mit

 This source file is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.

 For details please refer to: http://www.datatables.net/extensions/select
 Select for DataTables 1.4.0
 2015-2021 SpryMedia Ltd - datatables.net/license/mit
*/
(function (h) { "function" === typeof define && define.amd ? define(["jquery", "datatables.net"], function (r) { return h(r, window, document) }) : "object" === typeof exports ? module.exports = function (r, w) { r || (r = window); w && w.fn.dataTable || (w = require("datatables.net")(r, w).$); return h(w, r, r.document) } : h(jQuery, window, document) })(function (h, r, w, l) {
    function I(a, b, c) {
        var d = function (g, f) { if (g > f) { var k = f; f = g; g = k } var n = !1; return a.columns(":visible").indexes().filter(function (q) { q === g && (n = !0); return q === f ? (n = !1, !0) : n }) }; var e =
            function (g, f) { var k = a.rows({ search: "applied" }).indexes(); if (k.indexOf(g) > k.indexOf(f)) { var n = f; f = g; g = n } var q = !1; return k.filter(function (y) { y === g && (q = !0); return y === f ? (q = !1, !0) : q }) }; a.cells({ selected: !0 }).any() || c ? (d = d(c.column, b.column), c = e(c.row, b.row)) : (d = d(0, b.column), c = e(0, b.row)); c = a.cells(c, d).flatten(); a.cells(b, { selected: !0 }).any() ? a.cells(c).deselect() : a.cells(c).select()
    } function C(a) {
        var b = a.settings()[0]._select.selector; h(a.table().container()).off("mousedown.dtSelect", b).off("mouseup.dtSelect",
            b).off("click.dtSelect", b); h("body").off("click.dtSelect" + D(a.table().node()))
    } function J(a) {
        var b = h(a.table().container()), c = a.settings()[0], d = c._select.selector, e; b.on("mousedown.dtSelect", d, function (g) { if (g.shiftKey || g.metaKey || g.ctrlKey) b.css("-moz-user-select", "none").one("selectstart.dtSelect", d, function () { return !1 }); r.getSelection && (e = r.getSelection()) }).on("mouseup.dtSelect", d, function () { b.css("-moz-user-select", "") }).on("click.dtSelect", d, function (g) {
            var f = a.select.items(); if (e) {
                var k = r.getSelection();
                if ((!k.anchorNode || h(k.anchorNode).closest("table")[0] === a.table().node()) && k !== e) return
            } k = a.settings()[0]; var n = a.settings()[0].oClasses.sWrapper.trim().replace(/ +/g, "."); if (h(g.target).closest("div." + n)[0] == a.table().container() && (n = a.cell(h(g.target).closest("td, th")), n.any())) {
                var q = h.Event("user-select.dt"); u(a, q, [f, n, g]); q.isDefaultPrevented() || (q = n.index(), "row" === f ? (f = q.row, E(g, a, k, "row", f)) : "column" === f ? (f = n.index().column, E(g, a, k, "column", f)) : "cell" === f && (f = n.index(), E(g, a, k, "cell", f)),
                    k._select_lastCell = q)
            }
        }); h("body").on("click.dtSelect" + D(a.table().node()), function (g) { if (c._select.blurable && !h(g.target).parents().filter(a.table().container()).length && 0 !== h(g.target).parents("html").length && !h(g.target).parents("div.DTE").length) { var f = h.Event("select-blur.dt"); u(a, f, [g.target, g]); f.isDefaultPrevented() || z(c, !0) } })
    } function u(a, b, c, d) { if (!d || a.flatten().length) "string" === typeof b && (b += ".dt"), c.unshift(a), h(a.table().node()).trigger(b, c) } function N(a) {
        var b = a.settings()[0]; if (b._select.info &&
            b.aanFeatures.i && "api" !== a.select.style()) {
                var c = a.rows({ selected: !0 }).flatten().length, d = a.columns({ selected: !0 }).flatten().length, e = a.cells({ selected: !0 }).flatten().length, g = function (f, k, n) { f.append(h('<span class="select-item"/>').append(a.i18n("select." + k + "s", { _: "%d " + k + "s selected", 0: "", 1: "1 " + k + " selected" }, n))) }; h.each(b.aanFeatures.i, function (f, k) {
                    k = h(k); f = h('<span class="select-info"/>'); g(f, "row", c); g(f, "column", d); g(f, "cell", e); var n = k.children("span.select-info"); n.length && n.remove();
                    "" !== f.text() && k.append(f)
                })
        }
    } function O(a) {
        var b = new m.Api(a); a._select_init = !0; a.aoRowCreatedCallback.push({ fn: function (c, d, e) { d = a.aoData[e]; d._select_selected && h(c).addClass(a._select.className); c = 0; for (e = a.aoColumns.length; c < e; c++)(a.aoColumns[c]._select_selected || d._selected_cells && d._selected_cells[c]) && h(d.anCells[c]).addClass(a._select.className) }, sName: "select-deferRender" }); b.on("preXhr.dt.dtSelect", function (c, d) {
            if (d === b.settings()[0]) {
                var e = b.rows({ selected: !0 }).ids(!0).filter(function (f) {
                    return f !==
                        l
                }), g = b.cells({ selected: !0 }).eq(0).map(function (f) { var k = b.row(f.row).id(!0); return k ? { row: k, column: f.column } : l }).filter(function (f) { return f !== l }); b.one("draw.dt.dtSelect", function () { b.rows(e).select(); g.any() && g.each(function (f) { b.cells(f.row, f.column).select() }) })
            }
        }); b.on("draw.dtSelect.dt select.dtSelect.dt deselect.dtSelect.dt info.dt", function () { N(b); b.state.save() }); b.on("destroy.dtSelect", function () { b.rows({ selected: !0 }).deselect(); C(b); b.off(".dtSelect"); h("body").off(".dtSelect" + D(b.table().node())) })
    }
    function K(a, b, c, d) { var e = a[b + "s"]({ search: "applied" }).indexes(); d = h.inArray(d, e); var g = h.inArray(c, e); if (a[b + "s"]({ selected: !0 }).any() || -1 !== d) { if (d > g) { var f = g; g = d; d = f } e.splice(g + 1, e.length); e.splice(0, d) } else e.splice(h.inArray(c, e) + 1, e.length); a[b](c, { selected: !0 }).any() ? (e.splice(h.inArray(c, e), 1), a[b + "s"](e).deselect()) : a[b + "s"](e).select() } function z(a, b) { if (b || "single" === a._select.style) a = new m.Api(a), a.rows({ selected: !0 }).deselect(), a.columns({ selected: !0 }).deselect(), a.cells({ selected: !0 }).deselect() }
    function E(a, b, c, d, e) {
        var g = b.select.style(), f = b.select.toggleable(), k = b[d](e, { selected: !0 }).any(); if (!k || f) "os" === g ? a.ctrlKey || a.metaKey ? b[d](e).select(!k) : a.shiftKey ? "cell" === d ? I(b, e, c._select_lastCell || null) : K(b, d, e, c._select_lastCell ? c._select_lastCell[d] : null) : (a = b[d + "s"]({ selected: !0 }), k && 1 === a.flatten().length ? b[d](e).deselect() : (a.deselect(), b[d](e).select())) : "multi+shift" == g ? a.shiftKey ? "cell" === d ? I(b, e, c._select_lastCell || null) : K(b, d, e, c._select_lastCell ? c._select_lastCell[d] : null) : b[d](e).select(!k) :
            b[d](e).select(!k)
    } function D(a) { return a.id.replace(/[^a-zA-Z0-9\-_]/g, "-") } function A(a, b) { return function (c) { return c.i18n("buttons." + a, b) } } function F(a) { a = a._eventNamespace; return "draw.dt.DT" + a + " select.dt.DT" + a + " deselect.dt.DT" + a } function P(a, b) { return -1 !== h.inArray("rows", b.limitTo) && a.rows({ selected: !0 }).any() || -1 !== h.inArray("columns", b.limitTo) && a.columns({ selected: !0 }).any() || -1 !== h.inArray("cells", b.limitTo) && a.cells({ selected: !0 }).any() ? !0 : !1 } var m = h.fn.dataTable; m.select = {}; m.select.version =
        "1.4.0"; m.select.init = function (a) {
            var b = a.settings()[0]; if (!b._select) {
                var c = a.state.loaded(), d = function (t, G, p) {
                    if (null !== p && p.select !== l) {
                        a.rows({ selected: !0 }).any() && a.rows().deselect(); p.select.rows !== l && a.rows(p.select.rows).select(); a.columns({ selected: !0 }).any() && a.columns().deselect(); p.select.columns !== l && a.columns(p.select.columns).select(); a.cells({ selected: !0 }).any() && a.cells().deselect(); if (p.select.cells !== l) for (t = 0; t < p.select.cells.length; t++)a.cell(p.select.cells[t].row, p.select.cells[t].column).select();
                        a.state.save()
                    }
                }; a.one("init", function () { a.on("stateSaveParams", function (t, G, p) { p.select = {}; p.select.rows = a.rows({ selected: !0 }).ids(!0).toArray(); p.select.columns = a.columns({ selected: !0 })[0]; p.select.cells = a.cells({ selected: !0 })[0].map(function (L) { return { row: a.row(L.row).id(!0), column: L.column } }) }); d(l, l, c); a.on("stateLoaded stateLoadParams", d) }); var e = b.oInit.select, g = m.defaults.select; e = e === l ? g : e; g = "row"; var f = "api", k = !1, n = !0, q = !0, y = "td, th", M = "selected", B = !1; b._select = {}; !0 === e ? (f = "os", B = !0) : "string" ===
                    typeof e ? (f = e, B = !0) : h.isPlainObject(e) && (e.blurable !== l && (k = e.blurable), e.toggleable !== l && (n = e.toggleable), e.info !== l && (q = e.info), e.items !== l && (g = e.items), f = e.style !== l ? e.style : "os", B = !0, e.selector !== l && (y = e.selector), e.className !== l && (M = e.className)); a.select.selector(y); a.select.items(g); a.select.style(f); a.select.blurable(k); a.select.toggleable(n); a.select.info(q); b._select.className = M; h.fn.dataTable.ext.order["select-checkbox"] = function (t, G) {
                        return this.api().column(G, { order: "index" }).nodes().map(function (p) {
                            return "row" ===
                                t._select.items ? h(p).parent().hasClass(t._select.className) : "cell" === t._select.items ? h(p).hasClass(t._select.className) : !1
                        })
                    }; !B && h(a.table().node()).hasClass("selectable") && a.select.style("os")
            }
        }; h.each([{ type: "row", prop: "aoData" }, { type: "column", prop: "aoColumns" }], function (a, b) { m.ext.selector[b.type].push(function (c, d, e) { d = d.selected; var g = []; if (!0 !== d && !1 !== d) return e; for (var f = 0, k = e.length; f < k; f++) { var n = c[b.prop][e[f]]; (!0 === d && !0 === n._select_selected || !1 === d && !n._select_selected) && g.push(e[f]) } return g }) });
    m.ext.selector.cell.push(function (a, b, c) { b = b.selected; var d = []; if (b === l) return c; for (var e = 0, g = c.length; e < g; e++) { var f = a.aoData[c[e].row]; (!0 === b && f._selected_cells && !0 === f._selected_cells[c[e].column] || !(!1 !== b || f._selected_cells && f._selected_cells[c[e].column])) && d.push(c[e]) } return d }); var v = m.Api.register, x = m.Api.registerPlural; v("select()", function () { return this.iterator("table", function (a) { m.select.init(new m.Api(a)) }) }); v("select.blurable()", function (a) {
        return a === l ? this.context[0]._select.blurable :
            this.iterator("table", function (b) { b._select.blurable = a })
    }); v("select.toggleable()", function (a) { return a === l ? this.context[0]._select.toggleable : this.iterator("table", function (b) { b._select.toggleable = a }) }); v("select.info()", function (a) { return a === l ? this.context[0]._select.info : this.iterator("table", function (b) { b._select.info = a }) }); v("select.items()", function (a) { return a === l ? this.context[0]._select.items : this.iterator("table", function (b) { b._select.items = a; u(new m.Api(b), "selectItems", [a]) }) }); v("select.style()",
        function (a) { return a === l ? this.context[0]._select.style : this.iterator("table", function (b) { b._select || m.select.init(new m.Api(b)); b._select_init || O(b); b._select.style = a; var c = new m.Api(b); C(c); "api" !== a && J(c); u(new m.Api(b), "selectStyle", [a]) }) }); v("select.selector()", function (a) { return a === l ? this.context[0]._select.selector : this.iterator("table", function (b) { C(new m.Api(b)); b._select.selector = a; "api" !== b._select.style && J(new m.Api(b)) }) }); x("rows().select()", "row().select()", function (a) {
            var b = this;
            if (!1 === a) return this.deselect(); this.iterator("row", function (c, d) { z(c); c.aoData[d]._select_selected = !0; h(c.aoData[d].nTr).addClass(c._select.className) }); this.iterator("table", function (c, d) { u(b, "select", ["row", b[d]], !0) }); return this
        }); v("row().selected()", function () { var a = this.context[0]; return a && this.length && a.aoData[this[0]] && a.aoData[this[0]]._select_selected ? !0 : !1 }); x("columns().select()", "column().select()", function (a) {
            var b = this; if (!1 === a) return this.deselect(); this.iterator("column", function (c,
                d) { z(c); c.aoColumns[d]._select_selected = !0; d = (new m.Api(c)).column(d); h(d.header()).addClass(c._select.className); h(d.footer()).addClass(c._select.className); d.nodes().to$().addClass(c._select.className) }); this.iterator("table", function (c, d) { u(b, "select", ["column", b[d]], !0) }); return this
        }); v("column().selected()", function () { var a = this.context[0]; return a && this.length && a.aoColumns[this[0]] && a.aoColumns[this[0]]._select_selected ? !0 : !1 }); x("cells().select()", "cell().select()", function (a) {
            var b = this;
            if (!1 === a) return this.deselect(); this.iterator("cell", function (c, d, e) { z(c); d = c.aoData[d]; d._selected_cells === l && (d._selected_cells = []); d._selected_cells[e] = !0; d.anCells && h(d.anCells[e]).addClass(c._select.className) }); this.iterator("table", function (c, d) { u(b, "select", ["cell", b.cells(b[d]).indexes().toArray()], !0) }); return this
        }); v("cell().selected()", function () { var a = this.context[0]; return a && this.length && (a = a.aoData[this[0][0].row]) && a._selected_cells && a._selected_cells[this[0][0].column] ? !0 : !1 });
    x("rows().deselect()", "row().deselect()", function () { var a = this; this.iterator("row", function (b, c) { b.aoData[c]._select_selected = !1; b._select_lastCell = null; h(b.aoData[c].nTr).removeClass(b._select.className) }); this.iterator("table", function (b, c) { u(a, "deselect", ["row", a[c]], !0) }); return this }); x("columns().deselect()", "column().deselect()", function () {
        var a = this; this.iterator("column", function (b, c) {
            b.aoColumns[c]._select_selected = !1; var d = new m.Api(b), e = d.column(c); h(e.header()).removeClass(b._select.className);
            h(e.footer()).removeClass(b._select.className); d.cells(null, c).indexes().each(function (g) { var f = b.aoData[g.row], k = f._selected_cells; !f.anCells || k && k[g.column] || h(f.anCells[g.column]).removeClass(b._select.className) })
        }); this.iterator("table", function (b, c) { u(a, "deselect", ["column", a[c]], !0) }); return this
    }); x("cells().deselect()", "cell().deselect()", function () {
        var a = this; this.iterator("cell", function (b, c, d) {
            c = b.aoData[c]; c._selected_cells !== l && (c._selected_cells[d] = !1); c.anCells && !b.aoColumns[d]._select_selected &&
                h(c.anCells[d]).removeClass(b._select.className)
        }); this.iterator("table", function (b, c) { u(a, "deselect", ["cell", a[c]], !0) }); return this
    }); var H = 0; h.extend(m.ext.buttons, {
        selected: { text: A("selected", "Selected"), className: "buttons-selected", limitTo: ["rows", "columns", "cells"], init: function (a, b, c) { var d = this; c._eventNamespace = ".select" + H++; a.on(F(c), function () { d.enable(P(a, c)) }); this.disable() }, destroy: function (a, b, c) { a.off(c._eventNamespace) } }, selectedSingle: {
            text: A("selectedSingle", "Selected single"),
            className: "buttons-selected-single", init: function (a, b, c) { var d = this; c._eventNamespace = ".select" + H++; a.on(F(c), function () { var e = a.rows({ selected: !0 }).flatten().length + a.columns({ selected: !0 }).flatten().length + a.cells({ selected: !0 }).flatten().length; d.enable(1 === e) }); this.disable() }, destroy: function (a, b, c) { a.off(c._eventNamespace) }
        }, selectAll: { text: A("selectAll", "Select all"), className: "buttons-select-all", action: function () { this[this.select.items() + "s"]().select() } }, selectNone: {
            text: A("selectNone",
                "Deselect all"), className: "buttons-select-none", action: function () { z(this.settings()[0], !0) }, init: function (a, b, c) { var d = this; c._eventNamespace = ".select" + H++; a.on(F(c), function () { var e = a.rows({ selected: !0 }).flatten().length + a.columns({ selected: !0 }).flatten().length + a.cells({ selected: !0 }).flatten().length; d.enable(0 < e) }); this.disable() }, destroy: function (a, b, c) { a.off(c._eventNamespace) }
        }
    }); h.each(["Row", "Column", "Cell"], function (a, b) {
        var c = b.toLowerCase(); m.ext.buttons["select" + b + "s"] = {
            text: A("select" +
                b + "s", "Select " + c + "s"), className: "buttons-select-" + c + "s", action: function () { this.select.items(c) }, init: function (d) { var e = this; d.on("selectItems.dt.DT", function (g, f, k) { e.active(k === c) }) }
        }
    }); h(w).on("preInit.dt.dtSelect", function (a, b) { "dt" === a.namespace && m.select.init(new m.Api(b)) }); return m.select
});