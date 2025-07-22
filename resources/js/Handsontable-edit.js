import Handsontable from "handsontable";
import "handsontable/dist/handsontable.full.min.css";

const editor = document.querySelector("#editedTable");
const header = window.Laravel.headerTable;
const data = window.Datas.valueTable;
const roles = window.Roles.roles;
const coloringCol = window.ColoringColumn.coloringCol;

const isReadOnly = roles !== "ADMIN";

console.log("Header:", header);
console.log("Data:", data);
console.log("Roles:", roles);
console.log("Coloring Column:", coloringCol);

let suggestionHistory = new Set();
data.forEach((row) => {
    row.forEach((cell) => {
        if (typeof cell === "string" && cell.trim() !== "") {
            suggestionHistory.add(cell.trim());
        }
    });
});

function colorCellRenderer(
    instance,
    td,
    row,
    col,
    prop,
    value,
    cellProperties
) {
    Handsontable.renderers.TextRenderer.apply(this, arguments);
    const colHeader = header[col];
    const colorObj = coloringCol.find(
        (c) => parseInt(c.column) === row + 1 && c.header === colHeader
    );
    if (colorObj) {
        td.style.backgroundColor = colorObj.color_col;
        td.style.fontWeight = "500";
        td.style.color = "white";
    }
}

const hot = new Handsontable(editor, {
    data: data,
    rowHeaders: true,
    colHeaders: header,
    manualColumnResize: true,
    collapsibleColumns: true,
    autoWrapRow: true,
    autoWrapCol: true,
    readOnly: isReadOnly,
    stretchH: "all",
    licenseKey: "non-commercial-and-evaluation",
    search: {
        queryMethod: Handsontable.plugins.Search.DEFAULT_QUERY_METHOD,
        highlight: true,
    },
    columns: header.map(() => ({
        type: "autocomplete",
        strict: false,
        filter: true,
        allowInvalid: true,
        source: function (query, process) {
            const list = Array.from(suggestionHistory);
            if (!query) return process(list);
            const result = list.filter((item) =>
                item.toLowerCase().includes(query.toLowerCase())
            );
            process(result);
        },
    })),
    cells: function (row, col) {
        return { renderer: colorCellRenderer };
    },
    afterChange: function (changes, source) {
        if (source === "loadData" || !changes) return;

        changes.forEach(([row, prop, oldVal, newVal]) => {
            if (newVal && typeof newVal === "string") {
                suggestionHistory.add(newVal.trim());
            }
        });

        const jsonData = JSON.stringify({
            data: this.getSourceData(),
            colheaders: this.getColHeader(),
        });

        // Bisa pakai vanilla JS agar konsisten
        const hiddenInput = document.getElementById("handsontable-data");
        if (hiddenInput) hiddenInput.value = jsonData;

        console.log("Updated hidden input:", jsonData);
    },
});

// Set nilai awal hidden input supaya tidak kosong saat submit form pertama kali
const hiddenInput = document.getElementById("handsontable-data");
if (hiddenInput) {
    hiddenInput.value = JSON.stringify({
        data: data,
        colheaders: header,
    });
}

// Search plugin
const searchPlugin = hot.getPlugin("search");
const searchInput = document.getElementById("searchInput");
if (searchInput) {
    searchInput.addEventListener("keyup", function () {
        searchPlugin.query(this.value);
        hot.render();
    });
}
