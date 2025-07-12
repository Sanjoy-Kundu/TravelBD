    </main>
                <footer class="py-4 bg-light mt-auto no-print">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2025</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

<script>
    getUserInfo();
    async function getUserInfo(){
        let token = localStorage.getItem('token');
        if(!token){
            window.location.href = "/customer/login";
        }
        try{
          let res = await axios.get("/auth/customer",{headers:{
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json'
        }})
        console.log(res.data)

        if(res.data.status == "success"){
            document.querySelector(".customer_name").innerHTML = res.data.data.name;
            document.querySelector(".customer_id").value = res.data.data.id;
            document.querySelector(".nav_customer_user_email").innerHTML = res.data.data.email;
        }
        }catch(error){
           // middleware error check 
            if (error.response && error.response.status === 401) {
                alert(error.response.data.message); // "Unauthorized"
                //  Token invalid → redirect to login
                localStorage.removeItem('token');
                window.location.href = "/customer/login";
            } else {
                alert("Something went wrong!");
                console.error("Unexpected error:", error);
            }
        }
    }
    
</script>        