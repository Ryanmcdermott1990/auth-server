import axios from "axios";
import './bootstrap';

// Setting the window object to a new instance of axios 
window.axios = axios;

// Run the make request on initilising the JS 
makeRequest()

// Async function that takes the response from the outh/clients endpoint, destructures the response and passes it in to another function to manage the data
async function makeRequest() {
    const response = await axios.get('/oauth/clients')
    const { data } = response
    console.log(data)
    return manageData(data)
};

// Manage data is used to take the response from the ouath/clients endpoint and then dynamically render HTML that is injected in to a div element in the dashboard view 
function manageData(data) {
    // declare the html as an empty string 
    let html = '';
    // iterate through the response and append html to the DOM 
    for (const item of data) {
        html += `<div class="border px-1 py-1"><strong>ID:</strong><p>${item?.id}</p><strong>Name:</strong><h1>${item.name}</h1><strong>RedirectURL:</strong><h2>${item?.redirect}</h3><strong>Client_Secret:</strong><h4>${item?.secret}</h4><button x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" onclick="submitEdit(${item?.id}, '${item?.name}', '${item?.redirect}')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Edit</button><button class="bg-red-600 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 m-0.5" onclick="handleDelete(${item?.id})">Delete</button></div>`
    }
    document.getElementById('container').innerHTML = html


}

