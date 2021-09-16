$(function () {
    $(document).on("keyup", "#searchUser", function (e) {
        var user = $(this).val();
        if (user != "") {
            $.ajax({
                url: "/Session/crud/searchUser.php",
                type: "POST",
                data: {user: user},
                success: function (data) {
                    if (data != "") {
                        $("#user").html(data);
                    }
                }
            })
            console.log(user);
        }

    })

    function showTodo() {
        $.ajax({
            url: "/Session/crud/showTodo.php",
            type: "POST",
            success: function (data) {
                $("#tasksProgress").html(data)
            }

        });
    }

    function showTodosCompleted() {
        $.ajax({
            url: "/Session/crud/showCompletedToto.php",
            type: "POST",
            success: function (data) {
                $("#tasksCompleted").html(data)
            }

        });

    }

    function showFriend() {
        $.ajax({
            url: "/Session/crud/showFriend.php",
            type: "POST",
            success: function (data) {
                $("#friends").html(data)
            }
        })
    }

    function showNotification() {
        $.ajax({
            url: "/Session/crud/showNotification.php",
            type: "POST",
            success: function (data) {
                $("#notifications").html(data)
            }
        })
    }

    function showWaitInvit() {
        $.ajax({
            url: "/Session/crud/showWaitInvit.php",
            type: "POST",
            success: function (data) {
                $("#waitInvitation").html(data)
            }
        })

    }

    function allFunction() {
        showFriend();
        showTodosCompleted();
        showTodo();
        showNotification();
        showWaitInvit();

    }

    allFunction();


    function add(addTodo) {
        $.ajax({
            url: "/Session/crud/addTodo.php",
            type: "POST",
            data: {addTodo: addTodo},
            success: function (data) {
                if (data == 1) {
                    allFunction();
                } else {
                    alert(data);
                }
            }
        })
    }

    $("#addListForm").on("click", function (e) {
        e.preventDefault();
        var nameTodo = $("#nameTodo").val();
        if (nameTodo == "") {
            alert("Merci de remplir la tâche")
        } else {
            add(nameTodo);
        }

    });

    $(document).on("click", "#removeTodo", function (e) {
        e.preventDefault();
        var valueId = $(this).data('id');
        $.ajax({
            url: "/Session/crud/removeTodo.php",
            type: "POST",
            data: {valueId: valueId},
            success: function (data) {
                if (data == 1) {
                    allFunction();
                } else {
                    alert(data);
                }
            }
        })

    })

    $(document).on("click", "#changeEtat", function (e) {
        e.preventDefault();
        var valueId = $(this).data('id');
        $.ajax({
            url: "/Session/crud/changeEtatTodo.php",
            type: "POST",
            data: {valueId: valueId},
            success: function (data) {
                if (data == 1) {
                    allFunction();
                } else {
                    alert(data);
                }
            }
        })
    })

    $(document).on("click", "#deleteAllTaskCompleted", function (e) {
        e.preventDefault();
        $.ajax({
            url: "/Session/crud/deleteAllTaskCompleted.php",
            type: "POST",
            success: function (data) {
                if (data == 1) {
                    allFunction();
                } else {
                    alert(data);
                }

            }
        })
    });

    $(document).on("click", "#sendMail", function (e) {
        e.preventDefault();
        var email = $(this).data('email');
        var pseudo = $(this).data('pseudo');
        var chooseWrite = $("#chooseWrite").val();


        $.ajax({
            url: "/Session/sendMail/sendMail.php",
            type: "POST",
            data: {email: email, pseudo: pseudo, chooseWrite: chooseWrite},
            success: function (data) {
                if (data != "") {
                    allFunction();

                } else {
                    alert("Vous avez déja envoyé une invite");
                }

            }
        })
    })

    $(document).on("click", "#deleteFriend", function (e) {
        e.preventDefault();
        var idInvit = $(this).data('id');
        $.ajax({
            url: "/Session/crud/deleteFriend.php",
            type: "POST",
            data: {idInvit: idInvit},
            success: function (data) {
                if (data != "") {
                    allFunction();
                } else {
                    alert(alert);
                }

            }
        })

    })

    $(document).on("click", "#acceptFriend", function (e) {
        e.preventDefault();
        var idInvit = $(this).data('id');
        $.ajax({
            url: "/Session/crud/acceptInvit.php",
            type: "POST",
            data: {idInvit: idInvit},
            success: function (data) {
                if (data != "") {
                    allFunction();
                } else {
                    alert(alert);
                }

            }
        })
    })

    $(document).on("click", "#blocked", function (e) {
        e.preventDefault();
        var idInvit = $(this).data('id');
        $.ajax({
            url: "/Session/crud/blockedFriend.php",
            type: "POST",
            data: {idInvit: idInvit},
            success: function (data) {
                if (data != "") {
                    allFunction();
                } else {
                    alert(alert);
                }

            }
        })
    })

})