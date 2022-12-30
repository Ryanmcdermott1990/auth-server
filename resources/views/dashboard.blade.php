    <!-- Be sure to add any resources that are added in the JS directory to the vite.config.js, then add them to the top of the blade file -->
    
    <head>
        @vite(['resources/css/app.css', 'resources/js/dashboard.js'])
    </head>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <script src="{{ asset('js/dashboard.js') }}" defer></script>

        {{-- <div class="container mx-auto"> --}}
        <div class="flex">
            <div class="w-1/2">
                <div class="p-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            @csrf

                            <!-- Name input variable for creating a new client -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Client name" required autofocus />
                            </div>

                            <!-- Redirect URL input variable for creating a new client-->
                            <div class="py-4">
                                <x-input-label for="redirect" :value="__('Redirect Link')" />
                                <x-text-input id="redirect" class="block mt-1 w-full" type="text" name="redirect" placeholder="https://facebook.com" required autofocus />
                            </div>
                            <script>
                                // Submit function is an asyncronous function that makes a post request to the oauth/clients endpoint, it will then use the form values to make that request
                                async function submit() {
                                    await axios.post('/oauth/clients', {
                                        name: document.getElementById('name').value,
                                        redirect: document.getElementById('redirect').value,
                                    })
                                    window.location.replace('http://auth-server.test/dashboard')
                                }

                                // Async funciton to handle editing the record in the edit form 
                                async function handleEditSubmit() {
                                    await axios.put('/oauth/clients/' + document.getElementById('edit-id').value, {
                                        name: document.getElementById('edit-name').value,
                                        redirect: document.getElementById('edit-redirect').value,
                                    })
                                    window.location.replace('http://auth-server.test/dashboard')
                                }

                                // Function to handle submitting the create client form 
                                // The original values are taken and used to propagate the form 
                                function submitEdit(id, name, redirect) {
                                    const nameInput = document.getElementById("edit-name")
                                    const redirectInput = document.getElementById("edit-redirect")
                                    const idInput = document.getElementById("edit-id")

                                    idInput.value = id
                                    nameInput.value = name
                                    redirectInput.value = redirect
                                }

                                // Async function that will delete the record, this takes an id that is passed in to the function to locate the element that is to be deleted 
                                async function handleDelete(id) {
                                    await axios.delete('/oauth/clients/' + id)
                                    window.location.replace('http://auth-server.test/dashboard')
                                }
                            </script>
                            <!-- A modal that was created in the Breeze installation has been used to facilitate the edit modal -->
                            <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

                                

                                <!-- ID edit form field-->
                                <div>
                                    <x-input-label for="id" :value="__('ID')" class="ml-1" />
                                    <x-text-input id="edit-id" class="block mt-1 w-full" type="number" name="id" required autofocus readonly />
                                </div>

                                <!-- Name edit form field -->
                                <div>
                                    <x-input-label for="name" :value="__('Name')" class="ml-1" />
                                    <x-text-input id="edit-name" class="block mt-1 w-full" type="text" name="name" placeholder="Client name" required autofocus />
                                </div>

                                <!-- Redirect URL edit form field -->
                                <div class="py-4">
                                    <x-input-label for="redirect" :value="__('Redirect Link')" class="ml-1" />
                                    <x-text-input id="edit-redirect" class="block mt-1 w-full" type="text" name="redirect" :value="old('email')" placeholder="https://facebook.com" required autofocus />
                                </div>
                                <!-- Button to confirm editing the client, calls the handleEditSubmit() function that makes an axios put request to update the record details -->
                                <div class="flex  justify-start m-1">
                                    <x-primary-button id="edit-click" onclick="handleEditSubmit()">
                                        {{ __('Edit Client') }}
                                    </x-primary-button>
                                    <x-secondary-button x-on:click="$dispatch('close')" class="m-1">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                </div>

                            </x-modal>
                                <!-- Button to create a new client, an onclick handler has been added which calls the submit() function that is declared earlier in this blade file -->
                            <div class="flex  justify-start">
                                <x-primary-button onclick="submit()">
                                    {{ __('Create Client') }}
                                </x-primary-button>
                            </div>

                            </form>
                            <div id="container">
                            </div>
                        </div>
                    </div>
                </div>
            </div>




    </x-app-layout>