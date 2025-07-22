import "./bootstrap";

import Handsontable from "handsontable";
import "handsontable/dist/handsontable.full.min.css";

//ADD DATA
const container = document.querySelector("#example");

const nameHeader = window.Laravel.nameHeader;

const headerName = nameHeader.nama_header;
const jumlahKolom = nameHeader.jumlah_baris;

const count = headerName.length;

const suggestionHistory = new Set(); // simpan nilai-nilai yang pernah diketik

const hot = new Handsontable(container, {
    startCols: count,
    startRows: jumlahKolom,
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

    columns: headerName.map(() => ({
        type: "autocomplete",
        strict: false,
        filter: true,
        source: function (query, process) {
            const list = Array.from(suggestionHistory);
            if (!query) return process(list);
            const result = list.filter((item) =>
                item.toLowerCase().includes(query.toLowerCase())
            );
            process(result);
        },
    })),
    afterChange: function (changes, source) {
        if (source === "edit" || source === "Autofill.fill") {
            changes.forEach(([row, col, oldVal, newVal]) => {
                if (newVal) {
                    suggestionHistory.add(newVal);
                }
            });
        }

        const jsonData = JSON.stringify({
            data: this.getSourceData(),
            colheaders: this.getColHeader(),
            rowheaders: this.getRowHeader(),
        });

        $("#handsontable-data").val(jsonData);
    },
});
