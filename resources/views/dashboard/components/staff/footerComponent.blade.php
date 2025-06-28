    </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
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
            window.location.href = "/staff/login";
        }
        try{
          let res = await axios.get("/auth/staff",{headers:{
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json'
        }})
        console.log(res.data)

        if(res.data.status == "success"){
            console.log(res.data.data.staff_code)
            document.querySelector(".staff_name").innerHTML = res.data.data.name;
            document.querySelector(".nav_staff_user_code").innerHTML = res.data.data.staff_code;
            document.querySelector(".nav_staff_user_role").innerHTML = res.data.data.role;
            document.querySelector(".nav_staff_user_email").innerHTML = res.data.data.email;
        }
        }catch(error){
           // middleware error check 
            if (error.response && error.response.status === 401) {
                alert(error.response.data.message); // "Unauthorized"
                //  Token invalid → redirect to login
                localStorage.removeItem('token');
                window.location.href = "/staff/login";
            } else {
                alert("Something went wrong!");
                console.error("Unexpected error:", error);
            }
        }
    }
    
</script>        