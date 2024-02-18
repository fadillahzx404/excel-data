import "./bootstrap";

import Handsontable from "handsontable";
import "handsontable/dist/handsontable.full.min.css";

//ADD DATA
const container = document.querySelector("#example");

const nameHeader = window.Laravel.nameHeader;
const headerName = nameHeader.nama_header;

const count = headerName.length;
const hot = new Handsontable(container, {
    startCols: count,
    startRows: 10,
    rowHeaders: true,
    colHeaders: headerName,
    manualColumnResize: true,
    collapsibleColumns: true,
    autoWrapRow: true,
    autoWrapCol: true,
    height: "auto",
    width: "auto",
    contextMenu: ["row_above", "row_below", "remove_row"],
    stretchH: "all",
    licenseKey: "non-commercial-and-evaluation",
    afterChange: function (source, changes) {
        let jsonData;

        jsonData = JSON.stringify({
            data: this.getSourceData(),
            colheaders: this.getColHeader(),
            rowheaders: this.getRowHeader(),
        });

        // update the hidden form field with the new data

        $("#handsontable-data").val(jsonData);
    },
});
