function populateCasesTable(caseData) {
	const table = document.querySelector('#casesTable')

	caseData.forEach(item => {
		const row = document.createElement('tr');
		for (const key in item) {
			const cell = document.createElement('td');
			cell.textContent = item[key];
			row.appendChild(cell);
		}
		table.appendChild(row);
	});
}

function generateCaseListRow(id, name, dob, found) {

}

window.onload = () => {
	fetch("/api/cases.php")
		.then((response) => response.json())
		.then((json) => console.log(json));
	 const caseData = [ { caseId: '001', name: 'John Doe', dob: '1990-01-01', found: 'Yes' }, { caseId: '002', name: 'Jane Smith', dob: '1985-05-15', found: 'No' }, { caseId: '003', name: 'Sam Johnson', dob: '1977-11-30', found: 'Yes' } ];
	 populateCasesTable(caseData);

};