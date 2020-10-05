<template>
    <div class="auth-warrper">
        <input type="radio" name="option" id="auth-menu-1">
        <input type="radio" name="option" id="auth-menu-2" checked>
        <div></div>
            <form class="auth-menu reg" @submit.prevent="Auth">
                <h2>Войти</h2>
                <input type="text" v-model="email_auth" placeholder="Email" required>
                <input type="password" v-model="password_auth" placeholder="Пароль" required>
                <button type="submit" class="btn_std">Войти</button>
                <label class="btn_std" for="auth-menu-1">Регистрация</label>
                <div class="error" v-if="!Passwords_do_not">Неверный пароль</div>
                <div class="error" v-if="!empty">Не все поля заполненны</div>
                 <div class="error" v-if="GetMessage">{{GetMessage}}</div>
            </form>
            <form class="auth-menu auth" @submit.prevent="Register">
                <h2>Регистрация</h2>
                <input type="text" v-model="name" placeholder="Имя" required>
                <input type="text" v-model="surname" placeholder="Фамилия" required>
                <input type="text" v-model="middenaem" placeholder="Отчество" required>
                <input type="text" v-model="email_reg" placeholder="Email" required>
                <input type="password" v-model="password" placeholder="Пароль" required>
                <input type="password" v-model="password_repid" placeholder="Повторите пароль" required>
                <div class="select_photo">
                    <img id="img" :src="avatar">
                </div>
                <label for="imgInput" class="btn_std"><i class="fa fa-cloud-upload"></i>Выберете файл</label>
                <input class="photo" @change="onPhotoChange" accept="image/png" type="file" name="file" ref="file" id="imgInput" required/>
                
                <button type="submit" class="btn_std">Зарегистрироватся</button>
                <label for="auth-menu-2" class="btn_std">Вход</label>
                <div class="error" v-if="!Passwords_do_not_match">Пароли не совпадают</div>
                <div class="error" v-if="!empty">Не все поля заполненны</div>
                <div class="error" v-if="GetMessage">{{GetMessage}}</div>
                
            </form>

    </div>
</template>

<script>
import Axios from "axios"
import Vue from "vue"
import { mapActions, mapGetters } from 'vuex'
export default {
    data()
    {
        return {
            email_auth: '',
            password_auth: '',
            name: '',
            surname: '',
            middenaem: '',
            email_reg: '',
            password: '',
            password_repid: '',
            avatar: '',
            Passwords_do_not_match: true,
            empty: true,
            Passwords_do_not: true,
            image: ''
        }
    },
    computed: mapGetters('user', ['GetMessage']),
    methods: mapActions('user', ['Registration']),
    methods:
    {
        ...mapActions('user', ['Registration', 'Loging']),
        Register()
        {
            
            // if(this.name == '' || this.surname == '' ||
            //     this.middenaem == '' || this.email_reg ||
            //     this.password == '' || this.password_repid == '')
            //     this.empty = false;
             if(this.password_repid != this.password)
                this.Passwords_do_not_match = false;
            else
            {
                var User = new FormData();
                User.append("name", this.name);
                User.append("Surname", this.surname);
                User.append("middenaem", this.middenaem);
                User.append("image", this.image);
                User.append("email", this.email_reg);
                User.append("password", this.password);

                // const User = {
                //     name: this.name,
                //     Surname: this.surname,
                //     Middlename: this.middenaem,
                //     Photo: this.image,
                //     email: this.email_reg,
                //     password: this.password
                // }
                // this.$store.dispatch("user/Registration", User);
                this.Registration(User);
            }
            
        },

        Auth()
        {
            if(this.email_auth == '' || this.password_auth == '')
                 this.empty = false;
            else
            {
                const Auth = {
                    email: this.email_auth,
                    password: this.password_auth
                }

                this.Loging(Auth);
            }
        },
        onPhotoChange(e)
        {
            var files = e.target.files || e.dataTransfer.files;
            if(files)
            {
                this.image = this.$refs.file.files[0];
                console.log(this.image);
                var reader = new FileReader();
                reader.onload = (es) => {
                this.avatar = es.target.result;
                };
                reader.readAsDataURL(files[0])
            }
            console.log(this.avatar);
        }
    }
}
</script>