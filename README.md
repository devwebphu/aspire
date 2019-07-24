document about api:
1) login
URL: {base_url}/auth/login 
Method: post
Param body :
{
"login":"phubui",
"password":"12345"
}

2) register user
URL: {base_url}/auth/register 
Method: post  
Param body:
{
"username":"phubui",
"password":"123458",
"email":"strongover1@gmail.com"
}

3) create loan
URL: {base_url}/loans/{user_id}/create-loan
Method: post  
Param body: 
{
"duration"                    : 36,
    "repayment_frequence_amount"  : 500,
    "repayment_frequence"        :6,
    "interest_rate"            :10,
    "fee"                      :25,
    "arrangement"              :""
}

4) create repayment
URL: {base_url}/loans/{user_id}/{loan_id}/create-repayment 
Method: post  
Param body:   
{
"amount"                    : 100,
"description"  : ""
}
