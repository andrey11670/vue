<template>
    <div class="">Изменить доступы</div>
    <h3>Разрешить {{ user.name }} доступ к данным</h3>

    <form  @submit.prevent="updatePassword">
    <div class="" style="display: flex;gap: 50px">

        <div class="">
            <h4 class="">Пароли</h4>
            <div class=""
                 v-for="(item, index) in password"
                 :key="index"

                 style="display: flex; gap: 25px;">
                <input
                    type="checkbox"
                    :id="'checkbox' + index"
                    v-model="checkedPassword"
                    :value="item.id" >

                <label :for="'checkbox' + index">{{item.name}} </label>
                <div v-bind:style="getStyle(item.user.id)"> Создатель:   {{item.user.name}}</div>
            </div>
        </div>

        <div class="">
            <h4 class="">Папки</h4>
            <div class="" >
                <div class="" v-for="(item, index) in folder" :key="index"  style="display: flex; gap: 25px;">
                    <input
                        type="checkbox"
                        :id="'checkbox' + index "
                        v-model="checkedFolder"
                        :value="item.id" >

                    <label :for="'checkbox' + index">{{item.name}} </label>
                    <div v-bind:style="getStyle(item.user.id)"> Создатель:  {{item.user.name}}</div>
                </div>
            </div>
        </div>

    </div>

        <button type="submit" >Редактировать</button>

    </form>
</template>

<script>
import axios from "axios";


export default {
    data() {
        return {
            //id пользователя доступы к кот мы редактируем
            id : null,
            //таблица со всеми доступными этому пользователю Паролями из бд
            passwordAccess : {},
            //таблица со всеми доступными этому пользователю Папками из бд
            folderAccess : {},

            user : [],
            //все пароли и папки
            password : [],
            folder : {},
            //массивы с выбраннми чекбоксами доступными пользователю
            checkedPassword: [],
            checkedFolder: [],
        };
    },
    mounted() {
        //сохраняем из get наш id для использования в отправке PUT
        this.id = this.$route.params.id;
        // переменная для get axios
        const id = this.$route.params.id;


        //принимем гет запрос от пользователя и сохраняем id пароля
        // ${id} эта цифра приходит от const id = this.$route.params.id;
        axios.get(`/api/users/${id}/access`)
            .then(response => {
                this.password = response.data.password;
                this.passwordAccess = response.data.passwordAccess;
                this.user = response.data.user;
                this.folder = response.data.folder;
                this.folderAccess = response.data.folderAccess;
                //заносим в массив id паролей и папок доступных из бд
                this.checkPasswordAccess(this.passwordAccess, this.checkedPassword);
                this.checkFolderAccess(this.folderAccess, this.checkedFolder);
            })
            .catch(error => {
                console.error('An error occurred:', error);
                if(error.response.status === 401){
                    this.$router.push('/login');
                }
                console.error('An error occurred:', error);
                return Promise.reject(error);
            });
    },
    methods: {
        //добавляем желтый стиль папкам и паролям кот создал этот пользователь
        getStyle(index){

                if (this.id == index){
                    //console.log(index);
                    return {'background' : 'yellow'}
                }
                else{
                    return {}
                }
        },
        //отправляем через метод пут данные на бэк
        updatePassword() {
            axios.put('/api/users/' + this.id +'/access',{
                    checkedPassword: this.checkedPassword,
                    checkedFolder: this.checkedFolder
                } )
                .then(response => {
                    // обработка успешного ответа
                    //console.log( response.data.checkedPassword);
                    //обновляем наш массив с доступными этому пользователю данными
                    this.checkedPassword.length = 0;
                    this.checkedPassword = response.data.checkedPassword
                    this.checkedFolder =  response.data.checkedFolder
                })
                .catch(error => {
                    // обработка ошибки
                    console.error('An error occurred while updating password:', error);
                });
        },
        //добавляем id  доступных Паролей в массив для далнейшей обработки на фронте
        checkPasswordAccess(access, checked) {
            access.forEach(item => {
                if (item.user_id === this.user.id) {
                    checked.push(item.password_id); // Добавляем id элемента в массив checkedItems
                }
            })
        },
        checkFolderAccess(access, checked) {
            access.forEach(item => {
                if (item.user_id === this.user.id) {
                    checked.push(item.folder_id); // Добавляем id элемента в массив checkedItems
                }
            })
        }
    }

}
</script>

<style>
</style>
