  // Function to calculate age based on birthdate
    function calculateAge(birthDate) {
        const today = new Date();
        const dob = new Date(birthDate);
        let age = today.getFullYear() - dob.getFullYear();

        // Adjust age if birthday hasn't occurred yet this year
        if (today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
            age--;
        }

        return age;
    }

    // Function to fetch data from the API
    async function fetchData_district() {
        try {
            var tableBody = document.getElementById('patientTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';
            const addressCity = document.getElementById('addressCity').value;
            let apiUrl = '';
               
                apiUrl = `http://localhost/pretb/api/getPtInfor?addressCity=${encodeURIComponent(addressCity)}`;
            const response = await fetch(apiUrl);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const jsonData = await response.json();
            var tableBody = document.getElementById('patientTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';
            jsonData.forEach(function(patient) {
                var row = tableBody.insertRow();
                var cellDate = row.insertCell(0);
                var cellID = row.insertCell(1);
                var cellName = row.insertCell(2);
                var cellGender = row.insertCell(3);
                var cellAge = row.insertCell(4);
                var cellAddress = row.insertCell(5);
                var cellDistrict = row.insertCell(6);
                var cellMobileNumber = row.insertCell(7);
                var cellRsltDate = row.insertCell(8);
                var cellRslt1 = row.insertCell(9);
                var cellRslt2 = row.insertCell(10);
                var cellRslt3 = row.insertCell(11);
                var cellXRay = row.insertCell(12);
                var cellGneX = row.insertCell(13);
                var cellDx = row.insertCell(14);
                var cellAction = row.insertCell(15);

                cellID.textContent = patient.id;
                cellName.textContent = patient.name[0].text;
                cellGender.textContent = patient.gender;
                //cellBirthDate.textContent = patient.birthDate;
                cellAge.textContent = calculateAge(patient.birthDate);
                cellAddress.textContent = patient.address[0].text;
                cellDistrict.textContent = patient.address[0].district;
                cellMobileNumber.textContent = patient.telecom[0].value;
                cellDate.textContent = "NA";
                cellRsltDate.textContent = "NA";
                cellRslt1.textContent = "NA";
                cellRslt2.textContent = "NA";
                cellRslt3.textContent = "NA";                
                cellXRay.textContent = "NA";
                cellGneX.textContent = "NA";
                cellDx.textContent = "NA";
                cellAction.textContent = "NA";
            });
        } catch (error) {
            console.error('Error fetching data:', error.message);
        }
    }


async function fetchData_id() {
        try {
            var tableBody = document.getElementById('patientTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';
            const ptId = document.getElementById('ptId').value;
            let apiUrl = '';
            apiUrl = `http://localhost/pretb/api/getPtInfor?ptId=${encodeURIComponent(ptId)}`;
            const response = await fetch(apiUrl);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const jsonData = await response.json();
            var tableBody = document.getElementById('patientTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';
            jsonData.forEach(function(patient) {
                var row = tableBody.insertRow();
                var cellDate = row.insertCell(0);
                var cellID = row.insertCell(1);
                var cellName = row.insertCell(2);
                var cellGender = row.insertCell(3);
                var cellAge = row.insertCell(4);
                var cellAddress = row.insertCell(5);
                var cellDistrict = row.insertCell(6);
                var cellMobileNumber = row.insertCell(7);
                var cellRsltDate = row.insertCell(8);
                var cellRslt1 = row.insertCell(9);
                var cellRslt2 = row.insertCell(10);
                var cellRslt3 = row.insertCell(11);
                var cellXRay = row.insertCell(12);
                var cellGneX = row.insertCell(13);
                var cellDx = row.insertCell(14);
                var cellAction = row.insertCell(15);

                cellID.textContent = patient.id;
                cellName.textContent = patient.name[0].text;
                cellGender.textContent = patient.gender;
                //cellBirthDate.textContent = patient.birthDate;
                cellAge.textContent = calculateAge(patient.birthDate);
                cellAddress.textContent = patient.address[0].text;
                cellDistrict.textContent = patient.address[0].district;
                cellMobileNumber.textContent = patient.telecom[0].value;
                cellDate.textContent = "NA";
                cellRsltDate.textContent = "NA";
                cellRslt1.textContent = "NA";
                cellRslt2.textContent = "NA";
                cellRslt3.textContent = "NA";                
                cellXRay.textContent = "NA";
                cellGneX.textContent = "NA";
                cellDx.textContent = "NA";
                cellAction.textContent = "NA";
            });
        } catch (error) {
            console.error('Error fetching data:', error.message);
        }
    }

    async function fetchData_mbl() {
        try {
            var tableBody = document.getElementById('patientTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';
            const mbl = document.getElementById('mbl').value;
            let apiUrl = '';
            apiUrl = `http://localhost/pretb/api/getPtInfor?mobileNo=${encodeURIComponent(mbl)}`;
            const response = await fetch(apiUrl);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const jsonData = await response.json();
            var tableBody = document.getElementById('patientTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';
            jsonData.forEach(function(patient) {
                var row = tableBody.insertRow();
                var cellDate = row.insertCell(0);
                var cellID = row.insertCell(1);
                var cellName = row.insertCell(2);
                var cellGender = row.insertCell(3);
                var cellAge = row.insertCell(4);
                var cellAddress = row.insertCell(5);
                var cellDistrict = row.insertCell(6);
                var cellMobileNumber = row.insertCell(7);
                var cellRsltDate = row.insertCell(8);
                var cellRslt1 = row.insertCell(9);
                var cellRslt2 = row.insertCell(10);
                var cellRslt3 = row.insertCell(11);
                var cellXRay = row.insertCell(12);
                var cellGneX = row.insertCell(13);
                var cellDx = row.insertCell(14);
                var cellAction = row.insertCell(15);

                cellID.textContent = patient.id;
                cellName.textContent = patient.name[0].text;
                cellGender.textContent = patient.gender;
                //cellBirthDate.textContent = patient.birthDate;
                cellAge.textContent = calculateAge(patient.birthDate);
                cellAddress.textContent = patient.address[0].text;
                cellDistrict.textContent = patient.address[0].district;
                cellMobileNumber.textContent = patient.telecom[0].value;
                cellDate.textContent = "NA";
                cellRsltDate.textContent = "NA";
                cellRslt1.textContent = "NA";
                cellRslt2.textContent = "NA";
                cellRslt3.textContent = "NA";                
                cellXRay.textContent = "NA";
                cellGneX.textContent = "NA";
                cellDx.textContent = "NA";
                cellAction.textContent = "NA";
            });
        } catch (error) {
            console.error('Error fetching data:', error.message);
        }
    }
