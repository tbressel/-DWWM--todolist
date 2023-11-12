document.addEventListener('DOMContentLoaded', () => {

    // Listen to add new task button
    document.getElementById('new-btn').addEventListener('click', () => {
        toggleForm();
    })
   
    document.getElementById('task-btn').addEventListener('click', () => {
        toggleTasks();

    })
    
    
    
    
    /**
     * Make the add form visible or hide 
    */
   function toggleForm() {
       document.getElementById('addform').classList.toggle('active')
    }
    /**
     * Make tasks list to do visible or hidden
    */
   function toggleTasks() {
       document.getElementById('tasksList__container').classList.toggle('hidden')
       document.getElementById('tasksDone__container').classList.toggle('hidden')
    }
})