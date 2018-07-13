<template>
    <div >
        <!-- 
        <div class="container">
            <div class="row">

                <div class="col-xs-12 text-center padding-md">
                    
                    <p>Kies een speeldag: </p>

                    <select v-model="selectedMatchday" @change="filterMatches()" class="border-none outline-none border-bottom border-secondary padding-bottom-xs">
                        <option v-for=" matchday in matchdays" class="padding-xs" :id="matchday.id" >{{ matchday.match_day }}</option>
                    </select>

                </div>
            </div>
        </div>
        -->
        <div class="margin-down-lg " v-for="match in filteredMatches">
            
           
            <div  v-if="match.locked && !match.predicted" class="container margin-up-sm">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        Er kan geen voorspelling meer ingevoerd worden voor deze wedstrijd, omdat de wedstrijd al begonnen of gespeeld is. Helaas krijg je geen punten voor deze wedstrijd.
                    </div>
                </div>
            </div>

            <div  v-if="match.predicted" class="container margin-up-sm">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        Je hebt deze wedstrijd al voorspeld. Jouw voorspelling is:
                    </div>
                </div>
            </div>

            
            <div class="text-center bg-accent padding-up-sm margin-up-sm">
                <p class="inline-block padding-sides-sm bold"> {{ match.home_team }} <span v-if="match.predicted"> ({{ match.prediction['home_goals'] }}) </span> </p>
                <p class="inline-block padding-sides-sm bold">vs</p>
                <p class="inline-block padding-sides-sm bold"> {{ match.away_team }} <span v-if="match.predicted"> ({{ match.prediction['away_goals'] }}) </span></p>
            </div>
            
            <div class="bg-accent container padding-down-sm  margin-down-sm padding-up-sm">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p>{{ match.play_date }} {{ match.start_time.substr(0,5) }} - {{ match.end_time.substr(0,5) }} </p>
                    </div>
                </div>
            </div>

            <div v-if="!match.predicted && !match.locked"  class="container margin-up-sm">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <a :href="'/voorspelling-invoeren/' + match.id" class="shadow-xs bg-secondary uppercase text-light font-xs  text-center inline-block" style="padding-bottom: 10px; padding-top: 10px; width: 250px; border-radius: 50px;" >
                            Voorspelling invoeren
                        </a>
                    </div>
                </div>
            </div>
            
        </div>

    
    </div>
</template>

<script>
    export default {
        props: {
            rawmatchdays: null,
            rawmatches: null,
        },

        data() {
            return {
                matchdays: [],
                selectedMatchday: null,
                matches: null,
                matchesCopy: null,
                filteredMatches: null,
                loaded: false,
            }
        }, 

        beforeMount() {
            setTimeout(() => {

            this.matchdays = JSON.parse(this.rawmatchdays);
            this.matches = JSON.parse(this.rawmatches);
            
            this.filteredMatches = this.matches;
            
            setTimeout(() => {
                this.loaded = true;
            }, 1000);

            }, 1000)
        },

        methods: {
            filterMatches() {
                this.filteredMatches = collect(this.matches).filter((oldMatch)=> {
                    console.log(oldMatch, this.selectedMatchday);
                    console.log(oldMatch.play_date == this.selectedMatchday);
                    return oldMatch.play_date == this.selectedMatchday; 
                }).items;
            },
        }
    }    
</script>