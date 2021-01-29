<template>

    <div class="content">
        <h1 class="text-center" style="margin-bottom: 50px;">Пользователи</h1>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Email</th>
                        <th scope="col">Роль</th>
                        <th scope="col">Edit</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr v-for="(user, index) in users">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.role }}</td>
                            <td>
                                <button @click="onClickEdit(user)" class="btn user-action-icon"><i class="fa fa-edit edit-icon"></i></button>
                                <button @click="onClickDelete(user)" class="btn user-action-icon"><i class="fa fa-trash trash-icon"></i></button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Edit Role -->
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-weight: bold;"><i class="fa fa-edit edit-icon" style="margin-right: 15px;"></i>Изменить</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="my-title" for="selectRole">Изменить роль для {{ currentUser.name }}</label>
                        <select v-model="selectedRole" id="selectRole" class="custom-select custom-select-lg mb-3">
                            <option v-for="role in data.roles" v-bind:value="role" class="menu-item">{{ role }}</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button @click="confirmEdit(selectedRole)" type="button" class="btn btn-primary" data-dismiss="modal">Изменить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Delete User -->
        <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-weight: bold;"><i class="fa fa-trash trash-icon" style="margin-right: 15px;"></i>Удалить</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5><b>Внимание!</b></h5>
                        <p>Вы действительно хотите удалить пользователя:</p>
                        <p><b>{{ currentUser.name }}</b></p>
                        <p>и все его данные?</p>
                    </div>
                    <div class="modal-footer">
                        <button @click="confirmDelete" type="button" class="btn btn-primary" data-dismiss="modal">Удалить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

</template>

<script>
    import ApiServices from "../services/ApiServices";
    export default {
        data: () => ({
            users: [],
            selectedRole: 'student',
            currentUser: {},
        }),
        props: {
            data: {},
        },
        mounted() {
            this.refreshUsersList();
        },
        methods: {
            onClickEdit: function(user) {
                this.currentUser = user;
                $('#editUserModal').modal('show');
            },
            confirmEdit: function (role) {
                ApiServices.changeUserRole(this.currentUser.id, role).then( response => {
                    this.refreshUsersList();
                } );
            },
            onClickDelete: function (user) {
                this.currentUser = user;
                $('#deleteUserModal').modal('show');
            },
            confirmDelete: function () {
                ApiServices.deleteUser(this.currentUser.id).then( response => {
                    this.refreshUsersList();
                });
            },
            refreshUsersList: function () {
                ApiServices.getUsers().then( response => {
                    this.users = response.data;
                });
            }
        },
    }
</script>

<style scoped>
    .user-action-icon {
        margin: 6px;
    }
    .user-action-icon i {
        font-size: 24px;
    }
    .edit-icon {
        color: dodgerblue;
    }
    .trash-icon {
        color: orangered;
    }
</style>
