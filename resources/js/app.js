/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
//? https://stackoverflow.com/questions/23901663/what-is-the-bootstrap-folder-inside-laravel-for
import "./bootstrap";
import "flowbite";
import { createApp } from "vue";
import defaultComponent from "./components/ExampleComponent.vue";
import loginComponent from "./components/Login.vue";
import courtComp from "./components/Courts.vue";
import bookListComp from "./components/BookList.vue";
import bookComp from "./components/Book.vue";

const app = createApp({});
const route = () => {
    let url = window.location.pathname;
    // console.log(url); //temporary..

    let URLS_ROUTE = [];
    URLS_ROUTE["login"] = { pathname: "/login" };
    // URLS_ROUTE["default"] = { pathname: "" }; //, componentTag: "example-component"
    const componentName = "futsal-component";
    if (typeof url != "string") {
        app.component(componentName, defaultComponent);
        return;
    }
    url = url.toLowerCase();
    switch (url) {
        case URLS_ROUTE["login"].pathname.toLowerCase():
            app.component(componentName, loginComponent);
            break;
        default:
            app.component(componentName, defaultComponent);
            break;
    }

    app.component('courts',courtComp);
    app.component('book-list',bookListComp);
    app.component('book',bookComp);
};

route();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount("#app");
