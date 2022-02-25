$(document).ready(() => {
    showTask();
    deleteTask();
    alterTask();
    $('#title').html('create');
    

    $('#search').keyup(() => {
        if ($('#search').val()) {
            let search = $('#search').val();

            $.ajax({ //get obtener algo y post para enviar
                url: 'search.php',
                type: 'POST',
                data: { search },
                success: (response) => {
                    if (!response.error) {

                        let tasks = JSON.parse(response);
                        let template = '';
                        tasks.forEach((task) => {
                            template += `<li>
                                    ${task.name} --> ${task.description}
                                </li>`
                        });
                        document.querySelector('#container-card-list').classList.add('d-flex');
                        $('#container-list').html(template);

                    }
                }
            });

        }

    });

    let id = null;
    let edit = false;



    $('#task-form').submit((e) => {

        const postData = {
            id: id,
            name: $('#name').val(),
            description: $('#description').val()
        }

        e.preventDefault();
        let url = edit === false ? 'create.php' : 'alter.php';
        

        $.post(url, postData, (response) => {
            showTask();
            $('#save').text(response).addClass('text-center my-4 text-success text-uppercase');
            $('#task-form').trigger('reset');
            setTimeout(() => {
                $('#save').addClass('d-none');
            }, 5000);

            
        });



    });


    function showTask() {
        $.ajax({
            url: 'all.php',
            type: 'GET',
            success: (response) => {
                let template = '';
                let tasks = JSON.parse(response);

                tasks.forEach((task) => {
                    template += `
                        <tr>
                            <th scope="row">${task.id}</th>
                            <td>${task.name}</td>
                            <td>${task.description}</td>
                            <td>
                                <button class="btn btn-danger task-delete">DELETE</button>
                            </td>
                            <td>
                                <button class="btn btn-warning task-alter">ALTER</button>
                            </td>
                        </tr>
                    `;

                    $('#task').html(template);

                });
            }

        });
    }

    function deleteTask() {
        $(document).on('click', '.task-delete', (element) => {
            if (confirm("Are you sure you want to delete this task?")) {
                let idElement = element.target.parentElement.parentElement.children[0].textContent;
                
                $.post('delete.php', { idElement }, (response) => {

                    if (idElement === id) {
                        $('#task-form').trigger('reset');
                    }

                    showTask();
                    $('#save').text(response).addClass('text-center my-4 text-success text-uppercase');
                    setTimeout(() => {
                        $('#save').addClass('d-none');
                    }, 5000);
                });
            }
        });
    }

    function alterTask() {
        $(document).on('click', '.task-alter', (element) => {
            let idElement = element.target.parentElement.parentElement.children[0].textContent;
            $.post('find.php', { idElement }, (response) => {
                if (!response.error) {

                    $('#title').html('update');
                    
                    response = JSON.parse(response);
                    id = response[0].id;
                    $('#name').val(response[0].name);
                    $('#description').val(response[0].description);
                    edit = true;
                }

            });
        });
    }



})



