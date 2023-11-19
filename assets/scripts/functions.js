   
/**
 * 
 * fetch api file 
 * 
 * @param {*} action 
 * @param {*} id 
 * @param {*} token 
 */
function fetchApi(action, id, token) {
    fetch('api.php?action=' + action + '&id=' + id + '&token=' + token)
        .then(response => response.json())
        .then(data => {
            if (data.result) {
              console.log('ok');         
              return;
            } 
            console.log(id)
        });
}

//


async function fetchAPI(data, action, method) {
    try {
        const response = await fetch('api.php?action=' + action, {
            method: method,
            headers: {
                "Content-type": "application/json"
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }

        const jsonResponse = await response.json();

        console.log("Réponse JSON de l'API :", jsonResponse);

        if (!jsonResponse.result) {
            console.log('Erreur : la réponse de l\'API indique un problème.');
            return;
        }

        console.log('Traitement de la réponse OK !');
    } catch (error) {
        throw new Error(error);
    }
}





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
        // labelState = !labelState;
        closeForm();
    }
  
    /**
     * Make the add form visible or hide 
    */
    function toggleForm() {
        document.getElementById('addform').classList.toggle('active')
        // formState = !formState;
        closeLabel();
    }

    /**
     * Make tasks list to do visible or hidden
    */
    function toggleTasks() {
        document.getElementById('tasksList__container').classList.toggle('hidden')
        document.getElementById('tasksDone__container').classList.toggle('hidden')
    }

    /**
    * 
    * get the actual token
    * 
    * @returns 
    */
    function getToken() {
        return document.getElementById('token').value;
    }