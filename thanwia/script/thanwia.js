let valueOfSeat = document.getElementsByClassName("seat-value");
let submitButton = document.getElementsByClassName("submit-button");

document.addEventListener('DOMContentLoaded', function() {
    let submitButton = document.querySelector(".submit-button");

    submitButton.addEventListener('click', async function(event) {
        event.preventDefault();

        let seatNumber = document.querySelector('.seat-value[name="seatNumber"]').value;
        console.log(seatNumber);

        let url = `http://testone2023-001-site1.htempurl.com/convert%20excel%20to%20db/thanwia.php?seatNumber=${seatNumber}`;

        let response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (response.ok) {
            let data = await response.json();
            console.log(data);
            if(data.Code === 200){
                // console.log(data.Data.studentName)
                let notAvailableSeat = document.querySelector(".non-available-seat")
                notAvailableSeat.classList.add('d-none'); 
                let lineElement = document.querySelector(".line");
                lineElement.classList.remove('d-none'); 
                let studentName = document.querySelector(".student-name");
                // console.log(studentName.textContent)
                studentName.textContent = data.Data.studentName;
                let studentPercentage = document.querySelector(".student-percentage");
                studentPercentage.textContent = data.Data.percentage.toFixed(2);
                let studentDegree = document.querySelector(".student-degree");
                studentDegree.textContent = data.Data.studentDegree;
                let studentStatus = document.querySelector(".student-status");
                studentStatus.textContent = data.Data.studentStatus;    
                let availableSeat = document.querySelector(".available-seat");
                availableSeat.classList.remove('d-none'); 

            }else if(data.Code===400){
                // console.log("this is not found in database");
                let availableSeat = document.querySelector(".available-seat");
                availableSeat.classList.add('d-none'); 
                let lineElement = document.querySelector(".line");
                lineElement.classList.remove('d-none'); 
                let notAvailableSeat = document.querySelector(".non-available-seat")
                notAvailableSeat.classList.remove('d-none'); 
            }
        } else {
            console.error('Error:', response.statusText);
        }
    });
});
