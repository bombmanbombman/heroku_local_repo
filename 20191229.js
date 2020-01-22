onerror=handler;
function handler(message,url,line){
  pop='something is not right \n\n';
  pop += 'error is '+message+'\n';
  pop += 'happened in '+url+'\n';
  pop += 'located in '+line+'\n';
  alert(pop);
}
function getTarget(event){
  if(!event){
    event = window.event;
  }
  return event.target || event.srcElement;
}
/**c06/js/form.js */
// var elForm, elSelectPackage, elPackageHint, elTerms, elTermsHint; // Declare variables
const elForm          = document.getElementById('formSignup');          // Store elements
const elSelectPackage = document.getElementById('package');
const elPackageHint   = document.getElementById('packageHint');
const elTerms         = document.getElementById('terms');
const elTermsHint     = document.getElementById('termsHint');

function packageHint(event) {                                 // Declare function
  var pack = elSelectPackage.options[elSelectPackage.selectedIndex].value;     // Get selected option
  if (pack === 'monthly') {                              // If monthly package
    elPackageHint.innerHTML = 'Save $10 if you pay for 1 year!';//Show this msg
  } else {                                               // Otherwise
    elPackageHint.innerHTML = 'Wise choice!';            // Show this message
  }
  var whichelement = getTarget(event);
  console.log(whichelement);
}

function checkTerms(event) {                             // Declare function
  if (!elTerms.checked) {                                // If checkbox ticked
    elTermsHint.innerHTML = 'You must agree to the terms.'; // Show message
    event.preventDefault();                              // Don't submit form
  }
  var whichelement = getTarget(event);
  console.log(whichelement);
}

//Create event listeners: submit calls checkTerms(), change calls packageHint()
elForm.addEventListener('submit', function(event){checkTerms(event);}, false);
elSelectPackage.addEventListener('change', function(event){packageHint(event);}, false);
/**c06/js/mutation.js */
// var newEl, newText, listItems; // Declare variables

const elList  = document.getElementById('list');               // Get list
const addLink = document.getElementById('anchor');                   // Get add item button
const counter = document.getElementById('counter');            // Get item counter

function addItem(event) {                                    // Declare function
  event.preventDefault();                                    // Prevent link action
  var newEl = document.createElement('li');                  // New <li> element
  var newText = document.createTextNode('New list item');    // New text node
  newEl.appendChild(newText);                            // Add text to <li>
  elList.appendChild(newEl);                             // Add <li> to list
  var whichelement = getTarget(event);
  console.log(whichelement);
}

function updateCount(event) {                                 // Declare function
  var listItems = elList.getElementsByTagName('li').length;  // Get total of <li>s
  counter.innerHTML = listItems;                         // Update counter
  var whichelement = getTarget(event);
  console.log(whichelement);
}

addLink.addEventListener('click', function(event){addItem(event);}, false);       // Click on button
elList.addEventListener('DOMNodeInserted', function(event){updateCount(event);}, false); // DOM updated
/**06/js/html5-events.js */
function setup(event) {
  var textInput;
  textInput = document.getElementById('message2');
  textInput.focus();
  var whichelement = getTarget(event);
  console.log(whichelement);
}

window.addEventListener('DOMContentLoaded', setup, false);

window.addEventListener('beforeunload', function(event) {
  // This example has been updated to improve cross-browser compatibility (as recommended by MDN)
  var message = 'You have changes that have not been saved';
  (event || window.event).returnValue = message;
  var whichelement = getTarget(event);
  console.log(whichelement);
  return message;
});
/**c06/js/example.js */
var noteInput, noteName, textEntered, target;    // Declare variables

noteName = document.getElementById('noteName');  // Element that holds note
noteInput = document.getElementById('noteInput');// Input for writing the note

function writeLabel(e) {                         // Declare function
  if (!e) {                                      // If event object not present
    e = window.event;                            // Use IE5-8 fallback
  }
  target = e.target || e.srcElement;             // Get target of event
  textEntered = target.value;                    // Value of that element
  noteName.textContent = textEntered;            // Update note text
}


function recorderControls(e) {                   // Declare recorderControls()
  if (!e) {                                      // If event object not present
    e = window.event;                            // Use IE5-8 fallback
  }
  target = e.target || e.srcElement;             // Get the target element
  if (e.preventDefault) {                        // If preventDefault() supported
    e.preventDefault();                          // Stop default action
  } else {                                       // Otherwise
    e.returnValue = false;                   // IE fallback: stop default action
  }

  switch(target.getAttribute('data-state')) {    // Get the data-state attribute
    case 'record':                               // If its value is record
      record(target);                            // Call the record() function
      break;                                     // Exit function to where called
    case 'stop':                                 // If its value is stop
      stop(target);                              // Call the stop() function
      break;                                     // Exit function to where called
      // More buttons could go here...
  }
}

function record(target) {                        // Declare function
  target.setAttribute('data-state', 'stop');     // Set data-state attr to stop
  target.textContent = 'stop';                   // Set text to 'stop'
}

function stop(target) {
  target.setAttribute('data-state', 'record');   //Set data-state attr to record
  target.textContent = 'record';                 // Set text to 'record'
}

if (document.addEventListener) {                 // If event listener supported
  document.addEventListener('click', function(e) {// For any click document
    recorderControls(e);                         // Call recorderControls()
  }, false);                                     // Capture during bubble phase
  // If input event fires on noteInput input call writeLabel()
  noteInput.addEventListener('input', writeLabel, false); 
} else {                                         // Otherwise
  document.attachEvent('onclick', function(e) {  // IE fallback: any click
    recorderControls(e);                         // Calls recorderControls()
  });
 // If keyup event fires on noteInput call writeLabel()
  noteInput.attachEvent('onkeyup', writeLabel);
}



