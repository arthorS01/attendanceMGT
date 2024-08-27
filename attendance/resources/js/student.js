import {$,$$} from "./lib.js";


//add check button event
let allChecks = $$("#sign");

allChecks.forEach(check=>{
    check.addEventListener("Checked",e=>{
        let id = e.target.id;

        console.log(id);
    })
})