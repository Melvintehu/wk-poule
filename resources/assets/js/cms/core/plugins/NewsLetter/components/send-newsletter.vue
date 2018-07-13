<template>
    <div class='col-lg-12 space-outside-up-sm'>
        <div>
            <h2>Verstuur nieuwsbrief</h2>
            <p class="space-inside-sm text-color-accent">
                Vul hieronder de velden in, en klik op: verstuur.
            </p>

            <div class="col-lg-12 space-inside-xs">
				<div class="row ">
					<div class="col-lg-12 reset-padding">
                        <div class="row">
                            <div class="col-lg-12 space-inside-up-sm" @click="openOverlay()">
                                <!-- add recipients -->
                                <div class="transition-normal border-curved bg-secondary operationButton bg-hover-main inline-block 
                                space-inside-sm space-inside-sides-sm pointer">
                                    <i class="material-icons text-color-accent">add_circle_outline</i>
                                </div>
                                <div class="inline-block pointer">
                                    <p style="position: absolute; top: 35px;" class="space-inside-left-xs">Voeg ontvangers toe</p>
                                </div>
                            </div>
                        </div>

                        <div class="row" v-if="recipients !== null">
                            <div class="col-lg-2 space-inside-sides-xs space-inside-sm pointer" v-for="(recipient, index) in recipients">
                                <div class="bg-secondary border-curved" @click="removeRecipient(index)">
                                    <p class="space-inside-down-sm space-inside-left-sm text-hover-light bg-hover-delete transition-normal">
                                        <i style="position: relative; top: 7px;" class="material-icons space-inside-sides-xs">remove_circle</i> {{ recipient.name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 space-inside-xs ">
				<div class="row ">
					<div class="col-lg-12 reset-padding">
                        <!-- The input -->
                        <p class="text-bold space-inside-sm">Onderwerp</p>
                        <input 
                            placeholder="Onderwerp"
                            v-model="newsletter.subject"
                            type="text"
                            class="
                                border border-secondary border-curved outline-none
                                space-inside-sides-md space-inside-sm 
                                inline-block 
                                full-width
                                bg-secondary
                                " 
                        required>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 space-inside-xs ">
				<div class="row ">
					<div class="col-lg-12 reset-padding">
                        <!-- The input -->
                        <p class="text-bold space-inside-sm">Inhoud</p>
                        <quill-editor v-model="newsletter.content" :options="quillOptions" class="border border-secondary border-curved outline-none
                                inline-block 
                                full-width
                                bg-secondary"></quill-editor>
                    </div>
                </div>
            </div>

            <!-- Button for sending the email -->
			<div class="row space-inside-sides-xs">
				<div class="col-lg-12 space-inside-sides-sm space-inside-up-sm">
					<button  @click="send()" class="border-none outline-none bg-main shadow-xs text-color-light space-inside-sm space-inside-sides-md">Versturen</button>
				</div>
			</div>

            <overlay>
                <div class="col-lg-12 reset-padding">
						
                    <h1 class="text-color-dark text-left text-uppercase letter-spacing-sm text-bold space-inside-md">Selecteer personen</h1>
                    

                    <!-- Select users to send mail to. -->
                    <div class="row" v-if="users.length > 0">	
                        <h2>Selecteer users</h2>
                        <div class="col-lg-2 space-inside-sides-xs space-inside-sm pointer" v-for="(user, index) in users">
                            <div class="bg-secondary border-curved" @click="addRecipient(index)">
                                <p class="space-inside-down-sm space-inside-left-sm">
                                    <i style="position: relative; top: 7px;" class="material-icons space-inside-sides-xs">person_add</i> {{ user.name }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Selected users to send mail to. -->
                    <div class="row space-inside-up-sm" v-if="recipients.length > 0">	
                        <h2>Geselecteerde users</h2>
                        <div class="col-lg-2 space-inside-sides-xs space-inside-sm pointer" v-for="(user, index) in recipients">
                            <div class="bg-secondary border-curved" @click="removeRecipient(index)">
                                <p class="space-inside-down-sm space-inside-left-sm text-hover-light bg-hover-delete transition-normal">
                                    <i style="position: relative; top: 7px;" class="material-icons space-inside-sides-xs">remove_circle</i> {{ user.name }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </overlay>
        </div>
    </div>
</template>
<style type="text/css">
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
      opacity: 0
    }

    .operationButton {
        line-height: 10px;
    }

    .operationButton:hover > i{
        color: white !important;
    }

    .bg-hover-delete:hover {
        background-color: #e74c3c;
    }
</style>
<script>
    import Newsletter from '../models/Newsletter';

   export default {
       props: {

       },

       data() {
           return {
               recipients: [],
               users: [],
               newsletter: new Newsletter(),
               quillOptions: {
                   modules: {
                       toolbar: [
                            [{ 'header': 1 }, { 'header': 2 }],
                            ['bold', 'italic'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            ['link', 'image']
                        ]
                   }
               }
           }
       },

       mounted() {
           Factory.getStaticInstance('user').all().then((data) => {
               this.users = data;
           });
       },

        methods: {
            addRecipient(index) {
                this.recipients.push(_.head(this.users.splice(index, 1)));
                this.newsletter.recipients = this.recipients;
            },

            removeRecipient(index) {
                this.users.push(_.head(this.recipients.splice(index, 1)));
                this.newsletter.recipients = this.recipients;
            },

            openOverlay() {
                Event.fire('overlay:open');
            },

            send() {
                this.newsletter.save().then(() => {
                    Notifier.success("Nieuwsbrief verstuurd!");
                    this.newsletter = new Newsletter();
                }, () => {
                    Notifier.error("Er is iets fout gegaan.");
                });
                
            }

        
        }
   }   
</script>