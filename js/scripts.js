/**
 * Knowledge about Ajax from zybook and video from class Week 6 lecture Recordings
 * URL: https://learn.zybooks.com/zybook/DALCSCI2170SampangiFall2021/chapter/7/section/1
 * Date Accessed: 2021-10-25
 */

/**
 * changeStatus method for set the done value for processform.php in if (isset($_GET['complete'])) {} condition
 * 
 * @param {*} id l_id from mylist
 */

function changeStatus(id){
    //creating an XMLHttpRequest object
    let ajaxPostObj = new XMLHttpRequest();

    let label = document.getElementById("needToCheck" + id);
    //initialize the done value to 0
    let done = 0;
    /**
     * Check the checkbox is checked
     * URL: https://www.w3schools.com/jsref/prop_checkbox_checked.asp
     * Date Accessed: 2021-10-31
     */
    //if checkboxid.checked is true
    if(document.getElementById("checkbox" + id).checked) {
        //then set done equal to 1
        done = 1;
    }
    //to send a request to server, open the processfrom.php complete if condition and set complete equal to id and done equal to (0 or 1)
    ajaxPostObj.open("GET", "includes/processform.php?complete=" + id + "&done=" + done, true);
    //change the status
    ajaxPostObj.onreadystatechange = function(){
        if(ajaxPostObj.readyState == 4 && ajaxPostObj.status == 200) {
            /*
            //let label equal to the label from index.php to do list form
            let label = document.getElementById("needToCheck" + id)
            //let checkbox equal to the checkbox from index.php to do list form
            let checkbox = document.getElementById("checkbox" + id)
            //if done is equal to 1, which means checkbox is checked
            if(done == 1) {
                */
                /**
                 * add and remove CSS classes on an element
                 * URL: https://www.w3schools.com/jsref/prop_element_classlist.asp
                 * Date Accessed: 2021-10-31
                 */
                /*
                //label add style .complete from main.css
                label.classList.add("complete");
                //checkbox.checked is true
                checkbox.checked = true;
                //else if done is equal to 0, which means checkbox is not checked
            }else {
                //label remove style .complete from main.css
                label.classList.remove("complete");
                //checkbox.checked is false
                checkbox.checked = false;
            }
            */
           label.classList.toggle("complete");

            
        }
    }
    ajaxPostObj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajaxPostObj.send()
}

/**
 * delete method for delete value from to do list
 * 
 * @param {*} id l_id from mylist
 */
function deleteItem(id) {
    //creating an XMLHttpRequest object
    let ajaxPostObj = new XMLHttpRequest();
    //to send a request to server, open the processform delete if condition and set delete equal to id
    ajaxPostObj.open("GET", "includes/processform.php?delete=" + id, true);
    //change the status
    ajaxPostObj.onreadystatechange = function(){
        if(ajaxPostObj.readyState == 4 && ajaxPostObj.status == 200) {
            //get the tr from to do list
            let tableRow = document.getElementById("tableRow" + id);
            //if tableRow is not null, then we can delete it to remove the row
            if(tableRow != null) {
                /**
                 * learn remove a tr from table
                 * URL: https://www.w3schools.com/jsref/met_node_removechild.asp
                 * Date Accessed: 2021-10-31
                 */
                //remove tableRow
                tableRow.parentNode.removeChild(tableRow);
            }
        }
    }
    ajaxPostObj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajaxPostObj.send()
}




