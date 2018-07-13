<template>
   <div class="col-lg-12 space-outside-up-sm">
        <div>
            <h2>Bekijk nieuwsbrieven</h2>
            <ul class="list-group space-outside-sm">
                <li v-for="newsletter in newsletters" class="list-group-item pointer bg-hover-secondary transition-normal" @click="viewNewsletter(newsletter)">
                   <span>Onderwerp: <b>{{ newsletter.subject }}</b></span> 
                   <span class="right">verzonden op: <b>{{ newsletter.created_at.substr(0, 10) }}</b></span>
                </li>
            </ul>

            <overlay v-if="selectedNewsletter !== null">
                <h1>{{ selectedNewsletter.subject }}</h1>
                <p class="space-inside-up-xs space-inside-down-sm">verzonden op <strong>{{ selectedNewsletter.created_at.substr(0, 10) }}</strong></p>

                <div v-html="selectedNewsletter.content">

                </div>
            </overlay>
        </div>
   </div>
</template>

<script>
    import Newsletter from '../models/Newsletter';

   export default {
       props: {

       },

       data() {
           return {
               selectedNewsletter: null,
               newsletters: null,
           }
       },

       mounted() {
           Factory.getStaticInstance('newsletter').all().then((data) => {
               this.newsletters = data;
           });
       },

       methods: {
          viewNewsletter(newsletter) {
              this.selectedNewsletter = newsletter;
              setTimeout(() => {
                Event.fire('overlay:open');
              }, 100)
          }
       }
   }   
</script>

