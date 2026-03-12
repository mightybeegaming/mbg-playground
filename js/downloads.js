let sortDir = {};

function parseSize(size){
    const unit = size.slice(-2).toUpperCase();
    const value = parseFloat(size);
    if(unit === 'KB') return value * 1024;
    if(unit === 'MB') return value * 1024 * 1024;
    if(unit === 'GB') return value * 1024 * 1024 * 1024;
    return value;
}

function sortTable(col){
    const table = document.getElementById("fileTable");
    const tbody = table.tBodies[0];
    const rows = Array.from(tbody.rows);

    sortDir[col] = !sortDir[col];

    rows.sort((a, b) => {
        let x = a.cells[col].innerText.trim();
        let y = b.cells[col].innerText.trim();

        if(col === 1){
            x = parseSize(x);
            y = parseSize(y);
            return sortDir[col] ? x - y : y - x;
        }

        return sortDir[col]
            ? x.localeCompare(y, undefined, {numeric: true, sensitivity: 'base'})
            : y.localeCompare(x, undefined, {numeric: true, sensitivity: 'base'});
    });

    tbody.append(...rows);

    for(let i = 0; i < 2; i++) {
        const ind = document.getElementById(`sort-indicator-${i}`);
        if(!ind) continue;
        if(i === col) ind.innerText = sortDir[col] ? '▲' : '▼';
        else ind.innerText = '';
    }
}