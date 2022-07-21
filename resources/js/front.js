//richiedi bootstrap
window.Vue = require("vue");
//importa il componente App ,speciaele , in una cartella a parte, il resto e' su components
import App from "./views/App";
//mount e render dell'app di vue
const app = new Vue({
    el: "#root",
    render: (h) => h(App),
});
