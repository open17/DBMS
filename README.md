# DBMS Project 23F 
>数据库期末大作业

## 数据库设计

### ER图设计
<img src="design/ER1.png" style="background-color:#fff;"/>

### 逻辑设计
- buyer = (***buyer_id***, ***buyer_name***, buyer_salt, cart_id)
- admin = (***admin_id***, ***admin_name***, admin_salt)
- security_with_admin=(***security_id***, ***admin_id***,hash_password)
- security_with_buyer=(***security_id***, ***buyer_id***,hash_password)
- order=(***order_id***,date,payment,cart_id,buyer_id)
- admin_view_order=(***admin_id***,***order_id***)
- info=(***info_id***,buyer_id,post,street,city,country,email,phone)
- goods=(***goods_id***,goods_name,goods_inventory,goods_description,goods_pic,goods_information_pic)
- type=(***type_id***,goods_id,type_name,price)
- cart_contain_type=(***cart_id***,***type_id***)
- cart=(***cart_id***,buyer_id,total_price)

### 3NF化简
- buyer = (***buyer_id***, ***buyer_name***, buyer_salt, cart_id)
- admin = (***admin_id***, ***admin_name***, admin_salt)
- security_with_admin=(***admin_id***,hash_password)
- security_with_buyer=(***buyer_id***,hash_password)
- order=(***order_id***,date,payment,cart_id)
- admin_view_order=(***admin_id***,***order_id***)
- info=(***buyer_id***,post,street,city,country,email,phone)
- goods=(***goods_id***,goods_name,goods_inventory,goods_description,goods_pic,goods_information_pic)
- type=(***type_id***,***goods_id***,type_name,price)
- cart_contain_type=(***cart_id***,***type_id***)
- cart=(***cart_id***,total_price)





