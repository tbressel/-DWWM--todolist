document.addEventListener('DOMContentLoaded', () => {
    let formState = false;
    let labelState = false;

    // Listen to 'add a new task' button
    document.getElementById('new-btn').addEventListener('click', () => {
        toggleForm();
    })

    // Listen to 'toggle done tasks / todo tasks' button
    document.getElementById('task-btn').addEventListener('click', () => {
        toggleTasks();
    })

    //
    document.getElementById('btn-actions').addEventListener('click', (event) => {
        const target = event.target;
        if (target.classList.contains('btn')) {
            toggleLabel();
            const attributeValue = target.getAttribute('data-id');
            document.getElementById('task-value').setAttribute('value', attributeValue);
        }
    });

    // Listen to every "done tasks" button 
    document.getElementById('tasksDone__container').addEventListener('click', (event) => {
        if (event.target.getAttribute('class') === "js-todo-btn") {
            const id = event.target.dataset.id;
            fetchApi('todo', id, getToken());
        }
    });

    // Listen to all button inside the task container
    document.getElementById('tasksList__container').addEventListener('click', (event) => {
        // console.log(event.target)

        const id = parseInt(event.target.dataset.id);

        if (isNaN(id)) return;

        if (event.target.getAttribute('class') === "js-up-btn") {
            fetchApi('up', id, getToken());

        } else if (event.target.getAttribute('class') === "js-down-btn") {
            fetchApi('down', id, getToken());

        } else if (event.target.getAttribute('class') === "js-delete-btn") {
            fetchApi('delete', id, getToken());

        } else if (event.target.getAttribute('class') === "js-done-btn") {
            fetchApi('done', id, getToken());
        }
    })
});

// function displayError() {
//     const id = parseInt(event.target.dataset.id);
//     if(isNaN(id)) return;
// }

// Listen to add form
document.getElementById('formAdd').addEventListener('submit', async function (event) {
    event.preventDefault();

    const data = {
        action: 'add',
        token: getToken(),
        task_name: this.querySelector('input[name="task_name"]').value
    };

    fetchAPI(data, "add", "POST");
});

document.getElementById('tasksList__container').addEventListener('submit', async function (event) {
  
    if (event.target.classList.contains('formDate')) {
             event.preventDefault();

        const data = {
            action: 'date',
            token: getToken(),
            new_date: event.target.querySelector('input[name="new_date"]').value,
            id_task: event.target.querySelector('input[name="id_task"]').value
        };

        fetchAPI(data, "date", "POST");
    }

    if (event.target.classList.contains('formModify')) {
        event.preventDefault();

   const data = {
       action: 'modify',
       token: getToken(),
       new_task_name: event.target.querySelector('input[name="new_task_name"]').value,
       id_task: event.target.querySelector('input[name="id_task"]').value
   };

   fetchAPI(data, "modify", "POST");
}




});


