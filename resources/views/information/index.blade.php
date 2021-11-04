<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <script defer src="https://unpkg.com/alpinejs@3.5.0/dist/cdn.min.js"></script> 
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</body>
</head>
<body>
    
   <div x-data="postData()">
       {{-- {{informations}} --}}
       <p x-text="name"></p>
          <template x-for="info in informations" :key="info.id">
            
           <p x-text="info.title"></p>
       </template>   
       {{-- <div x-if="errors.length">
        <div x-for="error in errors" :key="index" v-text={{error}} >
           
   </div>
</div> --}}
         <form x-on:submit.prevent="createInfo" >
           
            <input type="text" x-model="form.title" /><br> 
            <template x-if="errors.title">
                <div x-text="titleerrors()"></div>
                 </template> 
            <input type="text" x-model="form.description" /><br> 
            {{-- <template x-for="error in errors">
              <div x-text="error[0]"></div>
               </template>  --}}
               <template x-if="errors.description">
                <div x-text="descriptionerrors()"></div>
                 </template>  
              
                 {{-- <p class=" text-red-500 text-xs text-center" v-if="errors.email">
                    {{ errors.email.join(" ") }}
                  </p>  --}}
            <button>Submit</button>
            <div x-text="name.toUpperCase()"></div>
            
         </form>
     
   </div>
     
<script>
   function postData(){
    //    const axios=require("axios");
   
    return{
        name:"Tanzim",
         informations:[],
         
         errors:[],
         
            isLoggedIn:false,
         posts:['Post One'],
         form:{
             title:"",
             description:""
         },
        click(){
            console.log("clicked");
        },
        titleerrors(){
           return this.errors.title.join(" ");
        },
        descriptionerrors(){
           return this.errors.description.join(" ");
        },
//       init() {
//        let infos= fetch('http://127.0.0.1:8000/allinformation')
//        .then(response => response.json())
//        .then(data =>this.informations=data);

        

            
// },
async init() {
        //     // let api=await  fetch('http://127.0.0.1:8000/allinformation');
        //     let response=axios.get('http://127.0.0.1:8000/allinformation');
        // //    let response=await api.json();
        //  console.log(response);
        //      this.informations=response;
         
        //  console.log(this.informations);
        
        try {
        const resp = await axios.get('http://127.0.0.1:8000/allinformation');
        this.informations=resp.data
        console.log(this.informations);
    } catch (err) {
        // Handle Error Here
         this.errors=err.message
         console.log(err);
        
    }

            
},
      //With Fetch
    //  createInfo(){
    //      console.log("Cliked",this.form);
    //     fetch('http://127.0.0.1:8000/information', {
    //   method: 'POST',
    //   headers: {
    //     'Content-Type': 'application/json',
    //      'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
    //   },
    //   body: JSON.stringify(this.form)
    // }).then(data=>{
    //     console.log(data);
    //     // this.informations+=data
    // })
    //    this.init();
  
    //     // const resp = await axios.post('http://127.0.0.1:8000/saveinformation',this.form);
    //     // console.log(resp.data);
   

    // }
    //With axios
     async createInfo(){
              try {
                const response = await axios.post('http://127.0.0.1:8000/information',this.form);
          console.log(response);
              } catch (error) {
                 
                    if(error.response.status === 422) {
                        this.errors = error?.response?.data?.errors;
                          console.log(this.errors);
                 
              }
          
          
         
          this.init();
     }
    
 }
   } 
   }
  
</script>
</html>