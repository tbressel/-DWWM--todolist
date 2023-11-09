// Listen to add new task button
document.getElementById('new-btn').addEventListener('click', () => {
    toggleForm();
})




/**
 * Make the add form visible or hide 
 */
function toggleForm() {
    document.getElementById('addform').classList.toggle('active')
}