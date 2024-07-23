<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const getCellValue = (row, index) => row.children[index].innerText || row.children[index].textContent;

        const comparer = (index, asc) => (a, b) => {
            const valA = getCellValue(asc ? a : b, index);
            const valB = getCellValue(asc ? b : a, index);
            return isNaN(valA) || isNaN(valB) ? valA.localeCompare(valB) : valA - valB;
        };

        document.querySelectorAll('th.sortable').forEach(headerCell => {
            headerCell.addEventListener('click', () => {
                const table = headerCell.closest('table');
                const thIndex = Array.prototype.indexOf.call(headerCell.parentNode.children,
                    headerCell);
                const isAsc = headerCell.classList.contains('sorted-asc');
                const isDesc = headerCell.classList.contains('sorted-desc');
                const direction = isAsc ? 'desc' : 'asc';

                table.querySelectorAll('th').forEach(th => th.classList.remove('sorted-asc',
                    'sorted-desc'));
                headerCell.classList.toggle(`sorted-${direction}`);

                Array.from(table.querySelectorAll('tbody tr'))
                    .sort(comparer(thIndex, isAsc))
                    .forEach(tr => table.querySelector('tbody').appendChild(tr));
            });
        });
    });
</script>
