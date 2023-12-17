# 网站设计
## 架构
- 前后端分离
- 后端路径: /api/...
- 交互: axios
## ER图
<img src="ER.png" style="background-color:#fff;"/>

## Logic Design
- goods=(goods_id,inventory,description,image,name,category,information,seller_id)
- type=(goods_id,type_id,seller_id,type_name,price)
- comment=(comment_id,content,pictures,rating,buyer_id,goods_id)
- buyer=(buyer_id,name,phone,salt,email,cart_id)
- seller=(seller_id,name,phone,salt,email,income)
- address=(address_id,post,detail_address,city,country)
- security=(security_id,password)
- cart=(cart_id,goods_id,quantity)
- goods_contain_in_cart=(cart_id,goods_id,num)
- purchase=(purchase_id,cart_id,buyer_id,price,time)
- buyer_security=(security_id,buyer_id)
- seller_security=(security_id,seller_id)
- sell=(sell_id,purchase_id,num,price,profit)