// Define the text you want to add
var applicantInfo = `Sir,\n         I Mr./Ms. __________________________________________of ____________class (in Capital letters and Surname,\nName,Father’s and Mother’s Name to be mentioned ) Division __________Roll No. ___________ wish to participate in NSS \n activities for the year _________ \n\n \nI shall abide by all rules and regulations of NSS Programme/ Special Camps and participate in the NSS Regular Programme /\nSpecial Camps conducted by College/University at own risk\n\n I further undertake to complete 120 hours of work in Regular Programme and atleast one Special Camp of Seven days,
 during this year / next year. (A student who was a volunteer of NSS in previous year and have not
 attended Special Camp can enroll only if he / she undertakes to participate in Special Camp in this year.) `;

// Calculate the X and Y coordinates for the text
var xApplicantInfo = 10; // Adjust the X-coordinate as needed
var yApplicantInfo = 100; // Adjust the Y-coordinate as needed


var dateText = "Date : _______________________";
var xDate = 10; // X-coordinate for the left-aligned "Date" text
var yDate = 160; // Adjust the top space

doc.text(dateText, xDate, yDate);

// Add "Signature of the Student" text
var signatureText = `Signature of the Student,
                
______________________    \n`;
var xSignatureText = 120;
var ySignatureText = 160;

doc.text(signatureText, xSignatureText, ySignatureText);

// Set the position and length of the horizontal line
var lineX1 = 10;      // Starting X-coordinate
var lineX2 = 200;     // Ending X-coordinate
var lineY = 180;      // Y-coordinate for the line
var lineWidth = 1.2; 
// Set the line width
doc.setLineWidth(lineWidth);

// Draw the horizontal line
doc.line(lineX1, lineY, lineX2, lineY);

// Add the centered text below the line
var text = "PERSONAL DATA OF STUDENT (ALL BLOCK LETTERS)";
var textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
var xText = (lineX2 - lineX1 - textWidth) / 2 + lineX1; // Center-align the text
var yText = lineY + 10; // Adjust the vertical position

doc.text(text, xText, yText);

// Add the provided information below the centered text
var information = [
    "1. Local Address: ___________________________________________",
    "Ward: ______   Contact No. (Mobile) __________________",
    "Email Id. ___________________________",
    "2. Hobbies/Interest: _______________________________________________",
    "3. Special Interest: ________________________________________ ",
    "(If you participate in College/ Outside in Singing /Music/ Drama/ Dance/Trekking",
    "/ Sports/ etc. activities. Please state level of participation.",
    "4. Blood Group: ______________ ",
    "5. Height : _______________",
    "6. Date of Birth : ___________________",
    "7. Enrolled as Voter: YES / NO. Pl State ____________ (Voter ID No. ____________________________ )",
    "8. Caste: SC/ST/NT/OBC/Others (Please state ________________________________________________",
    "9. Have you worked in NSS/NCC/MCC/Scout/Guide/Other- Pl specify _____________________________",
    "10. Toilet attached to your house – YES / NO, If No, commitment to construct Toilet within a year."
];

var textSpacing = 8; // Adjust the vertical spacing between each line
var fontFamily = "helvetica";

// Set the font family
doc.setFont(fontFamily, "normal");

// Iterate through the information lines and add them to the PDF
for (var i = 0; i < information.length; i++) {
    var xInfo = lineX1;
    var yInfo = yText + (i + 1) * textSpacing; // Adjust the vertical position for each line
    if (yInfo >= 260) {
        // If the 8th point has been printed, add a new page
        doc.addPage();
        // Reset the yInfo position for the new page
        yInfo = 10; // You can adjust this position as needed
    }
    doc.text(information[i], xInfo, yInfo);
}

// Save the PDF
doc.save('NSS_Enrollment_Form.pdf');