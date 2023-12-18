// Get the modal
var modal = document.getElementById("myModal");

// Get all buttons that opens the modal
var btns = document.getElementsByClassName("myBtn");

// Apply event listener to all buttons
// Get all buttons that opens the modal
var btns = document.getElementsByClassName("myBtn");

// Apply event listener to all buttons
for (var i = 0; i < btns.length; i++) {
  btns[i].onclick = function() {
    // Get the task id and text from the clicked button's data
    var taskId = this.getAttribute('data-task-id');
    var taskText = this.getAttribute('data-task-text');

    // Set the modal's content
    document.querySelector('.modal-content input[name="task_id"]').value = taskId;
    document.querySelector('.modal-content input[name="newTask"]').value = taskText;

    // Show the modal
    modal.style.display = "block";
  }
}

// Get all <span> elements that closes the modal
var spans = document.getElementsByClassName("close");

// Apply event listener to all spans
for (var i = 0; i < spans.length; i++) {
  spans[i].onclick = function() {
    modal.style.display = "none";
  }
}

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}