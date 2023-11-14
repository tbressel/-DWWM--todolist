document.addEventListener('DOMContentLoaded', () => {

    let formState = false;
    let labelState = false;


    // Listen to add new task button
    document.getElementById('new-btn').addEventListener('click', () => {
        toggleForm();
    })

    document.getElementById('task-btn').addEventListener('click', () => {
        toggleTasks();


    })
    document.getElementById('tasksList__container').addEventListener('click', (event) => {
        const target = event.target;
        if (target.classList.contains('btn')) {
            toggleLabel();
            const attributeValue = target.getAttribute('data-id');

            document.getElementById('task-value').setAttribute('value' , attributeValue);

        }
    })






    /**
     * Close form if it's not hidden
     */
    function closeForm() {
        document.getElementById('addform').classList.remove('active')
    }

    /**
     * Close label list
     */
    function closeLabel() {
        document.getElementById('labelList').classList.remove('active')
    }


    /**
     * Make the add form visible or hide 
    */
    function toggleLabel() {
        document.getElementById('labelList').classList.toggle('active')
        labelState = !labelState;
        closeForm();
    }
    
    
    /**
     * Make the add form visible or hide 
    */
    function toggleForm() {
        document.getElementById('addform').classList.toggle('active')
        formState = !formState;
        closeLabel();
    }
    
    
    /**
     * Make tasks list to do visible or hidden
    */
    function toggleTasks() {
        document.getElementById('tasksList__container').classList.toggle('hidden')
        document.getElementById('tasksDone__container').classList.toggle('hidden')
    }
})