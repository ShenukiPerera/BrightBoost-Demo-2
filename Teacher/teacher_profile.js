document.addEventListener("DOMContentLoaded", function() {

    // Populate staff details
    var staffDetails = sessionStorage.getItem("staffDetails");
    var staffData = JSON.parse(staffDetails);

    console.log(staffDetails);
    console.log(staffData);

    document.getElementById("name").innerText = staffData[0]["name"];
    document.getElementById("username").innerText = staffData[0]["username"];
    document.getElementById("role").innerText = staffData[0]["role"];
    document.getElementById("contactnumber").innerText = staffData[0]["contactnumber"];
    document.getElementById("email").innerText = staffData[0]["email"];
    // Add more fields as needed

    // Populate specialties list
    var specialtiesList = sessionStorage.getItem("teacherSpecialties");
    var specialtiesData = JSON.parse(specialtiesList);
    var ul = document.getElementById("specialtiesList"); // Corrected ID

    specialtiesData.forEach(function(specialty) {
        var li = document.createElement("li");
        li.innerText = specialty["speciality"];
        ul.appendChild(li);
    });
});



