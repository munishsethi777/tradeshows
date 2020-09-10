<detailsOfInternet :index="1" flag="true" :isdomestic="business_chosen == 'internet'?false:true"></detailsOfInternet>
<detailsOfInternet v-for="index in Number(detailedUsers)" :index="index + 1" flag="false" :isdomestic="business_chosen == 'internet'?false:true"></detailsOfInternet>
