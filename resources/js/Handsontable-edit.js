//EDIT DATA

import Handsontable from "handsontable";
import "handsontable/dist/handsontable.full.min.css";

const editor = document.querySelector("#editedTable");

const header = window.Laravel.headerTable;
let data = window.Datas.valueTable;
let roles = window.Roles.roles;
let coloringCol = window.ColoringColumn.coloringCol;
let coloringRow = window.ColoringRowing.coloringRow;
let Conditional;

console.log(data);

let colored = coloringCol.map((obj) => obj);
let coloredRow = coloringRow.map((obj) => obj);

if (roles !== "ADMIN") {
    Conditional = true;
} else {
    Conditional = false;
}

const hot = new Handsontable(editor, {
    data: data,
    rowHeaders: true,
    colHeaders: header,
    manualColumnResize: true,
    collapsibleColumns: true,

    autoWrapRow: true,
    autoWrapCol: true,
    readOnly: Conditional,
    stretchH: "all",
    licenseKey: "non-commercial-and-evaluation",
    afterChange: function (source, changes) {
        let jsonData;

        jsonData = JSON.stringify({
            data: this.getSourceData(),
            colheaders: this.getColHeader(),
        });

        // update the hidden form field with the new data

        $("#handsontable-data").val(jsonData);
    },
});

function colorHeadRenderer(
    instance,
    td,
    row,
    col,
    prop,
    value,
    cellProperties
) {
    Handsontable.renderers.TextRenderer.apply(this, arguments);
    let coloredCol = colored.find((c) => c.header === header[col]);
    if (coloredCol) {
        td.style.backgroundColor = coloredCol.color_col;
        td.style.fontWeight = "medium";
        td.style.color = "black";
    }
}

function colorRowRenderer(instance, td, row, col, prop, value, cellProperties) {
    Handsontable.renderers.TextRenderer.apply(this, arguments);
    const coloredRowObj = coloredRow.find((obj) => obj.index_row === row);

    if (coloredRowObj) {
        td.style.backgroundColor = coloredRowObj.color_row;
        td.style.fontWeight = "medium";
        td.style.color = "black";
    }
}

hot.updateSettings({
    columns: header.map((col, colIndex) => {
        let colorObj = colored.find((c) => c.header === col);

        if (colorObj) {
            return {
                renderer: colorHeadRenderer,
            };
        }
        return {};
    }),
    cells: function (row, col, prop) {
        const cellProperties = {};
        const coloredRowObj = coloredRow.find((obj) => obj.index_row === row);
        if (coloredRowObj) {
            cellProperties.renderer = colorRowRenderer;
        }
        return cellProperties;
    },
});
