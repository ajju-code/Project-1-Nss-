// Include the jsPDF library
const { jsPDF } = require('jspdf');
const mysql = require('mysql2'); // Use 'mysql2' instead of 'mysql'
const fs = require('fs');
const path = require('path');



document.addEventListener("DOMContentLoaded", function () {
  // Add an event listener to the form submission
  document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission behavior

    // Get the username from the form input
    const username = document.querySelector("#your_name").value;

    // Now you can use the 'username' variable as needed.
    // For example, you can send it to the server via an AJAX request or perform any other action.

    // For demonstration, let's display the username in the console.
    console.log("Username:", username);
  });
});



function formatDateIndianTimeZone(date) {
  const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
  return date.toLocaleDateString('en-IN', options);
}

const date = new Date(); // Get the current date in the Indian time zone
const formattedDate = formatDateIndianTimeZone(date);

// console.log(formattedDate); // Output: "01/03/2024" (for example)

const date_year=date.getFullYear();
console.log(date_year);

// Create a new instance of jsPDF with A4 page size
var doc = new jsPDF({
    format: 'a4' // Set the page format to A4
  });

// Set font size for the title
doc.setFontSize(16);  // Adjust the font size as needed





// Replace these with your actual database connection details
const dbConnection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'login'
});

// Retrieve the username from the command-line arguments
const args = process.argv.slice(2); // Get command-line arguments excluding the first two (node scriptname)
const username = args[0]; // Assuming the username is the first argument

// Define a function to fetch user data from the database
function fetchUserData(username, callback) {
  // Execute a database query to retrieve user data
  dbConnection.query('SELECT * FROM users WHERE username = ?', [username], (error, results) => {
    if (error) {
      return callback(error, null);
    }

    if (results.length > 0) {
      const userData = results[0];
      callback(null, userData);
    } else {
      callback(new Error('User not found'), null);
    }
  });
}

// Example usage: fetch user data by username
fetchUserData(username, (error, userData) => {
  if (error) {
    console.error('Error:', error);
    // Close the database connection
    dbConnection.end();
    return;
  }
  // Now, you can populate the PDF form with the user data
  const userName = userData.username;
   const photo = userData.photo;
  const rollno = userData.rollno;
  const father_name = userData.father_name;
  const mother_name = userData.mother_name;
  const surname = userData.surname;
  const gender = userData.gender;
  const category = userData.category;
  const address = userData.address;
  const contact = userData.contact;
  const dob = userData.dob;
  const zip = userData.zip;
  const city = userData.city;
  const department = userData.department;
  const year = userData.year;
  const email = userData.email;
  const hobbies = userData.hobbies;
  const special_interest = userData.special_interest;
  const blood_group = userData.blood_group;
  const height = userData.height;
  const voter = userData.voter;
  const voter_id = userData.voter_id;
  const worked_in_nss = userData.worked_in_nss;
  const toilet_attached = userData.toilet_attached;
  const parent_name = userData.parent_name;
  const office_address = userData.office_address;
  const parent_contact = userData.parent_contact;
  const relationship = userData.relationship;
  const profession = userData.profession;


  // console.log(photo)






// Calculate dimensions for the smaller photo box in pixels (1/5 of the original size)
var photoBoxWidth = 50; // 1/5 of the original width (250 pixels)
var photoBoxHeight = 50; // 1/5 of the original height (250 pixels)

// Calculate the position for the smaller photo box
var photoBoxX = doc.internal.pageSize.getWidth() - photoBoxWidth - 10; // Adjust as needed
var photoBoxY = 40; // Adjust as needed
// Add an image inside the box
const imageData = fs.readFileSync(`D:\\Xamp\\htdocs\\Nss\\images\\${photo}`);
doc.addImage(imageData, 'PNG', photoBoxX, photoBoxY, photoBoxWidth, photoBoxHeight);















// Get the width of the PDF page
var pageWidth = doc.internal.pageSize.getWidth();

// Define the text you want to add
var applicantInfo = `Sir,\n         I Mr./Ms. ${surname}  ${userName} ${father_name} ${mother_name} (in Capital letters and Surname,Name,Father’s  and Mother’s Name  to be\n mentioned ) Division ${department} RollNo.${rollno} wish to participate in NSS  activities for the year ${date_year} \nI shall abide by all rules and regulations of NSS Programme/ Special Camps and participate in the NSS Regular Programme /\nSpecial Camps conducted by College/University at own risk\n\n I further undertake to complete 120 hours of work in Regular Programme and atleast one Special Camp of Seven days,
 during this year / next year. (A student who was a volunteer of NSS in previous year and have not
 attended Special Camp can enroll only if he / she undertakes to participate in Special Camp in this year.) `;

// Calculate the X and Y coordinates for the text
var xApplicantInfo = 10; // Adjust the X-coordinate as needed
var yApplicantInfo = 100; // Adjust the Y-coordinate as needed






var dateText = `Date :${formattedDate}`;
var xDate = 10; // X-coordinate for the left-aligned `Date` text
var yDate = 150; // Adjust the top space

doc.text(dateText, xDate, yDate);

// Add `Signature of the Student` text
var signatureText = `Signature of the Student,
                
______________________    \n`;
var xSignatureText = 120;
var ySignatureText = 148;

doc.text(signatureText, xSignatureText, ySignatureText);

// Set the position and length of the horizontal line
var lineX1 = 10;      // Starting X-coordinate
var lineX2 = 200;     // Ending X-coordinate
var lineY = 165;      // Y-coordinate for the line
var lineWidth = 1.2; 
// Set the line width
doc.setLineWidth(lineWidth);

// Draw the horizontal line
doc.line(lineX1, lineY, lineX2, lineY);

// Add the centered text below the line
var text = `PERSONAL DATA OF STUDENT (ALL BLOCK LETTERS)`;
var textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
var xText = (lineX2 - lineX1 - textWidth) / 2 + lineX1; // Center-align the text
var yText = lineY + 5; // Adjust the vertical position

doc.text(text, xText, yText);

// Add the provided information below the centered text
var information = [
    `1. Local Address:${address}`,
      `Ward: ______   Contact No.(Mobile) : ${contact}`,
    `Email Id: ${email}`,
    `2. Hobbies/Interest: ${hobbies}`,
    `3. Special Interest: ${special_interest} `,
    `(If you participate in College/ Outside in Singing /Music/ Drama/ Dance/Trekking/ Sports/ etc. activities.`,
    ` Please state level of participation.`,
    `4. Blood Group: ${blood_group}          5. Height : ${height}`,
    
    `6. Date of Birth : ${dob}`,
    `7. Enrolled as Voter: YES / NO.        ${voter}\n  If Yes Pl State `,
    ` (Voter ID No. :       ${voter_id} )`,
    `8. Caste: SC/ST/NT/OBC/Others (Please state) :        ${category}`,
    `9. Have you worked in NSS/NCC/MCC/Scout/Guide/Other- Pl specify :       ${worked_in_nss}`,
    `10. Toilet attached to your house – YES / NO,              ${toilet_attached} \nIf No, commitment.to construct Toilet within a year`,
    
];

var textSpacing = 8; // Adjust the vertical spacing between each line
var fontFamily = `helvetica`;

// Set the font family
doc.setFont(fontFamily, `normal`);
var infoFontSize = 10; // Adjust the font size as needed

// Iterate through the information lines and add them to the PDF
for (var i = 0; i < information.length; i++) {
    var xInfo = lineX1;
    var yInfo = yText + (i+1) * textSpacing; // Adjust the vertical position for each line
    doc.setFontSize(infoFontSize);

    doc.text(information[i], xInfo, yInfo);
}

// Save the PDF
doc.save('NSS_Enrollment_Form.pdf');



var textwidth=13;
doc.setFontSize(textwidth)
// Calculate the text width for the first sentence
var firstSentence = `Proforma - II - Enrollment Form for the NSS Volunteers`;
var firstSentenceWidth = doc.getStringUnitWidth(firstSentence) * doc.internal.getFontSize() / doc.internal.scaleFactor;

// Calculate the X coordinate to center the first sentence
var x = (pageWidth - firstSentenceWidth) / 2;

// Draw the first sentence with reduced font weight

doc.setFont('helvetica', 'bold'); // Set the font family to `helvetica` with Bold weight
doc.text(firstSentence, x, 10);

// Manually draw a black underline right below the first sentence
var y1 = 10.5; // Y-coordinate for the underline right below the first sentence (reduced space)
doc.setDrawColor(0); // Set draw color to black
doc.setLineWidth(0.5); // Set line width for the underline
doc.line(x, y1, firstSentenceWidth+60, y1); // Draw the underline

// Calculate the text width for the second sentence
var secondSentence = `Application for Admission to NSS for the year 20____- 20 ____`;
var secondSentenceWidth = doc.getStringUnitWidth(secondSentence) * doc.internal.getFontSize() / doc.internal.scaleFactor;

// Calculate the X coordinate to center the second sentence
var x2 = (pageWidth - secondSentenceWidth) / 2;

// Set the Y-coordinate for the second sentence and increase space
var y2 = 20; // Increased space below the second sentence

// Draw the second sentence with reduced font weight
// Set the font weight to bold
doc.setFont('helvetica', 'bold'); // Set the font family to `helvetica` with Bold weight
doc.text(secondSentence, x2, y2);

// Add `Sr. No.:- __________` and `Year of Enrollment in NSS (Pl. tick) : I / II` with more spacing between them

// Set the font weight to bold
doc.setFont('helvetica', 'normal');
var srNoText = `Sr. No.:- __________`;
var yearEnrollmentText = `Year of Enrollment in NSS (Pl. tick) : I / II`;

var spacing = 15; // Add more space between the two texts

var combinedText = srNoText + ` `.repeat(spacing) + yearEnrollmentText; // Add spacing between them

var combinedTextWidth = doc.getStringUnitWidth(combinedText) * doc.internal.getFontSize() / doc.internal.scaleFactor;

var xCombined = (pageWidth - combinedTextWidth) / 2;
var y3 = y2 + 10; // Increased space below the second sentence

// Draw the combined text with reduced font weight
doc.text(combinedText, xCombined, y3);

// Add space before `NATIONAL SERVICE SCHEME` sentence
var spaceBeforeNationalServiceScheme = 10; // Adjust the space as needed

doc.setFont('helvetica', 'bold');

var nationalServiceSchemeText = `NATIONAL SERVICE SCHEME`;
var nationalServiceSchemeWidth = doc.getStringUnitWidth(nationalServiceSchemeText) * doc.internal.getFontSize() / doc.internal.scaleFactor;
var xNationalService = (pageWidth - nationalServiceSchemeWidth) / 2;
var yNationalService = y3 + spaceBeforeNationalServiceScheme;

// Center-align `NATIONAL SERVICE SCHEME`
doc.text(nationalServiceSchemeText, xNationalService, yNationalService);

// Add `To, The Programme Officer, NSS Unit,` to the left side with top space
doc.setFont('helvetica', 'normal');

var toTheProgrammeOfficerText = `To,\nThe Programme Officer, NSS Unit,`;
var xLeft = 10; // X-coordinate for the left-aligned text
var y4 = yNationalService + 20; // Adjust the top space

// Draw `To, The Programme Officer, NSS Unit,` with the left alignment and top space
doc.text(toTheProgrammeOfficerText, xLeft, y4);

// Draw lines below `The Programme Officer, NSS Unit,` with spacing
var lineY = y4 + 12; // Adjust the vertical position of the first line
var lineHeight = 5; // Adjust the line height

// Draw three lines with spacing
for (var i = 0; i < 3; i++) {
    doc.line(xLeft, lineY, xLeft + 60, lineY);
    lineY += lineHeight; // Adjust the vertical spacing between lines
}





// Save the PDF
// doc.save('NSS_Enrollment_Form.pdf');







// Calculate dimensions for the smaller photo box in pixels (1/5 of the original size)
var photoBoxWidth = 50; // 1/5 of the original width (250 pixels)
var photoBoxHeight = 50; // 1/5 of the original height (250 pixels)

// Calculate the position for the smaller photo box
var photoBoxX = pageWidth - photoBoxWidth - 10; // Adjust as needed
var photoBoxY = 40; // Adjust as needed

// Draw the smaller box for the passport-sized photo
doc.rect(photoBoxX, photoBoxY, photoBoxWidth, photoBoxHeight);





// Add text inside the smaller photo box
var photoText = ``;
doc.setFontSize(10); // Set the font size for the text inside the box
var textWidth = doc.getStringUnitWidth(photoText) * doc.internal.getFontSize() / doc.internal.scaleFactor;
var textX = photoBoxX + (photoBoxWidth - textWidth) / 2; // Center-align the text inside the box
var textY = photoBoxY + (photoBoxHeight - 10) / 2; // Vertically center the text

doc.text(photoText, textX, textY);

// Add the applicant information text
doc.text(applicantInfo, xApplicantInfo, yApplicantInfo);






// Add a new page
doc.addPage();

// Add the `Particulars of Guardians/Parents` section


doc.setFont('helvetica', 'bold'); // Set the font family to `helvetica` with Bold weight

var dummy=`Particulars of Guardians/Parents  Name :     ${parent_name}\n`;
doc.text(dummy, 10, 10);


var guardiansText = `
\nOffice Address :  ${office_address} \n\n    Mobile No. :  ${parent_contact}\n
Relationship with Student: ${relationship}           Profession : ${profession} \n
Date : ${formattedDate} `+`\n`+`                                                        `+`      Signature of Guardians / Parents _________________________`;

// Set the font family and size for the guardians text
var guardiansFontFamily = `helvetica`;
var guardiansFontSize = 12;

// Define the X and Y coordinates for the guardians text
var xGuardians = 10; // Adjust the X-coordinate as needed
var yGuardians = 10; // Adjust the Y-coordinate as needed

// Set the font family and size for the guardians text
doc.setFont(guardiansFontFamily, 'normal');
doc.setFontSize(guardiansFontSize);

// Draw the guardians text
doc.text(guardiansText, xGuardians, yGuardians);

// Set the position and length of the horizontal line
var lineX1 = 10;      // Starting X-coordinate
var lineX2 = 200;     // Ending X-coordinate
var lineY = 60;      // Y-coordinate for the line
var lineWidth = 1.2; 
// Set the line width
doc.setLineWidth(lineWidth);

// Draw the horizontal line
doc.line(lineX1, lineY, lineX2, lineY);



// Define the bullet/star symbol using its Unicode representation
var bulletSymbol = '\u2022'; // .

// Create an array to hold the text lines
var additionalInfo = [
    ` ${bulletSymbol} Fresh T.Y. Students cannot enroll as; this scheme is designed for two years.Students of T.Y. Classes can enroll for NSS,\nonly if he/she has completed atleast 120 hours of Social Work in previous year.`,
    ` ${bulletSymbol} Have you completed 120 hours in Regular NSS? YES/NO, if yes, Year ______________Class____________`,
    ` ${bulletSymbol} Have you attended 07 days Special Camp? YES/NO, if yes, Year _____________Class ___________`
];

// Set the font family and size for the additional information
var additionalInfoFontFamily = `times`;
var additionalInfoFontSize = 10;

// Define the X and Y coordinates for the additional information
var xAdditionalInfo = 10; // Adjust the X-coordinate as needed
var yAdditionalInfo = 70; // Adjust the Y-coordinate as needed

// Set the font family and size for the additional information
doc.setFont(additionalInfoFontFamily, 'normal');
doc.setFontSize(additionalInfoFontSize);

// Iterate through the lines and add them to the PDF
for (var i = 0; i < additionalInfo.length; i++) {
    doc.text(additionalInfo[i], xAdditionalInfo, yAdditionalInfo);
    yAdditionalInfo += 12; // Adjust the vertical spacing between lines
}

// Set the position and length of the horizontal line
var lineX1 = 10;      // Starting X-coordinate
var lineX2 = 200;     // Ending X-coordinate
var lineY = 100;      // Y-coordinate for the line
var lineWidth = 1.2; 
// Set the line width
doc.setLineWidth(lineWidth);

// Draw the horizontal line
doc.line(lineX1, lineY, lineX2, lineY);




// Define the `FOR OFFICE USE ONLY` text
var forOfficeUseText = 'FOR OFFICE USE ONLY :';

// Set the font family and size for the text
var forOfficeUseFontFamily = 'helvetica';
var forOfficeUseFontSize = 12;

// Define the X and Y coordinates for the text
var xForOfficeUse = 10; // Adjust the X-coordinate as needed
var yForOfficeUse = 108; // Adjust the Y-coordinate as needed

// Set the font family and size for the text
doc.setFont(forOfficeUseFontFamily, 'bold');
doc.setFontSize(forOfficeUseFontSize);

// Draw the `FOR OFFICE USE ONLY` text
doc.text(forOfficeUseText, xForOfficeUse, yForOfficeUse);


// Define the rest of the information
var officeUseInfo = [
    `${bulletSymbol} Whether accepted as NSS Volunteer : YES / NO                            Application received date : __________`,
    `${bulletSymbol} If Yes, received NSS Registration Fee of Rs. 10/- :                `+`          YES / NO`,
    `${bulletSymbol} Allocated Volunteer Enrolment Code Number (V.E.C.) :                  M H 0 9 __ __ __ __ __ __ __ _`
];

// Set the font family and size for the rest of the information
var officeUseFontFamily = 'helvetica';
var officeUseFontSize = 10;

// Define the X and Y coordinates for the rest of the information
var xOfficeUse = 10; // Adjust the X-coordinate as needed
var yOfficeUse = 115; // Adjust the Y-coordinate as needed

// Set the font family and size for the rest of the information
doc.setFont(officeUseFontFamily, 'normal');
doc.setFontSize(officeUseFontSize);

// Iterate through the lines and add them to the PDF
for (var i = 0; i < officeUseInfo.length; i++) {
    doc.text(officeUseInfo[i], xOfficeUse, yOfficeUse);
    yOfficeUse += 9; // Adjust the vertical spacing between lines
}



// Define the text for `Name of Unit Incharge,` `NSS Programme Officer,` and `Signature`
var unitInchargeText = `Name of Unit Incharge NSS Programme Officer\n
______________________________________   `;
// var programmeOfficerText = 'NSS Programme Officer';
var signatureText = `   Signature\n`;

// Set the font family and size for the text
var signatureFontFamily = 'helvetica';
var signatureFontSize = 10;

// Define the X and Y coordinates for the text
var xUnitIncharge = 10; // Adjust the X-coordinate as needed
var xProgrammeOfficer = 100; // Adjust the X-coordinate as needed
var xSignature = 165; // Adjust the X-coordinate as needed
var ySignature = 155; // Adjust the Y-coordinate as needed

// Set the font family and size for the text
doc.setFont(signatureFontFamily, 'normal');
doc.setFontSize(signatureFontSize);

// Draw the `Name of Unit Incharge` text
doc.text(unitInchargeText, xUnitIncharge, ySignature);

// Draw the `NSS Programme Officer` text
// doc.text(programmeOfficerText, xProgrammeOfficer, ySignature);

// Draw the `Signature` text
doc.text(signatureText, xSignature, ySignature);




doc.setLineWidth(0.5); // Set the line weight (adjust as needed)
doc.line(155, 170, 205, 170); // Horizontal line at Y-coordinate 170



// Set the position and length of the horizontal line
var lineX1 = 10;      // Starting X-coordinate
var lineX2 = 200;     // Ending X-coordinate
var lineY = 172;      // Y-coordinate for the line
var lineWidth = 1.2; 
// Set the line width
doc.setLineWidth(lineWidth);




// Add the text above the underline
doc.text(`THIS APPLICATION FORM IS NOT FOR SALE, ENROLLED STUDENT SHOULD PAY REGISTRATION FEES RS. 10/- ONLY`, 10, 179);

// Add a line under the text
doc.setLineWidth(0.5); // Set the line weight (adjust as needed)
doc.line(12, 180, 208, 180); // Horizontal line right under the text




// Draw the horizontal line
doc.line(lineX1, lineY, lineX2, lineY);

doc.save('NSS_Enrollment_Form.pdf');
dbConnection.end();

});
