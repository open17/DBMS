# DBMS Project 23F 
> 数据库期末大作业

## 数据库设计

### ER图设计
<img src="design/ER1.png" style="background-color:#fff;"/>

### 逻辑设计
- buyer = (***buyer_id***, ***buyer_name***, buyer_salt, cart_id)
- admin = (***admin_id***, ***admin_name***, admin_salt)
- security_with_admin=(***security_id***, ***admin_id***,hash_password)
- security_with_buyer=(***security_id***, ***buyer_id***,hash_password)
- orders=(***order_id***,date,payment,cart_id,buyer_id)
- admin_view_order=(***admin_id***,***order_id***)
- info=(***info_id***,buyer_id,post,street,city,country,email,phone)
- goods=(***goods_id***,goods_name,goods_inventory,goods_description,goods_pic,goods_information_pic)
- goods_type=(***goods_type_id***,goods_id,goods_type_name,price)
- cart_contain_goods_type=(***cart_id***,***goods_type_id***)
- cart=(***cart_id***,buyer_id,total_price)

### 3NF化简
- buyer = (***buyer_id***, ***buyer_name***, buyer_salt, cart_id)
- admin = (***admin_id***, ***admin_name***, admin_salt)
- security_with_admin=(***admin_id***,hash_password)
- security_with_buyer=(***buyer_id***,hash_password)
- orders=(***order_id***,date,payment,cart_id)
- admin_view_order=(***admin_id***,***order_id***)
- info=(***buyer_id***,post,street,city,country,email,phone)
- goods=(***goods_id***,goods_name,goods_inventory,goods_description,goods_pic,goods_information_pic)
- goods_type=(***goods_type_id***,goods_id,goods_type_name,price)
- cart_contain_goods_type=(***cart_id***,***goods_type_id***)
- cart=(***cart_id***,total_price)

## 数据库建立

### 建表与主键约束
```sql
CREATE TABLE buyer (
    buyer_id INT,
    buyer_name VARCHAR(255),
    buyer_salt VARCHAR(255),
    cart_id INT,
    PRIMARY KEY (buyer_id, buyer_name)
);

CREATE TABLE admin (
    admin_id INT,
    admin_name VARCHAR(255),
    admin_salt VARCHAR(255),
    PRIMARY KEY (admin_id, admin_name)
);

CREATE TABLE security_with_admin (
    admin_id INT PRIMARY KEY,
    hash_password VARCHAR(255)
);

CREATE TABLE security_with_buyer (
    buyer_id INT PRIMARY KEY,
    hash_password VARCHAR(255)
);

CREATE TABLE orders (
    order_id INT PRIMARY KEY,
    order_date DATE,
    payment VARCHAR(255),
    cart_id INT
);

CREATE TABLE admin_view_order (
    admin_id INT,
    order_id INT,
    PRIMARY KEY (admin_id, order_id)
);

CREATE TABLE info (
    buyer_id INT PRIMARY KEY,
    post VARCHAR(255),
    street VARCHAR(255),
    city VARCHAR(255),
    country VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(255)
);

CREATE TABLE goods (
    goods_id INT PRIMARY KEY,
    goods_name VARCHAR(255),
    goods_inventory INT,
    goods_description VARCHAR(255), 
    goods_pic VARCHAR(255),
    goods_information_pic VARCHAR(255)
);

CREATE TABLE goods_type (
    goods_type_id INT PRIMARY KEY,
    goods_id INT,
    goods_type_name VARCHAR(255),
    price DECIMAL(10, 2)
);

CREATE TABLE cart_contain_goods_type (
    cart_id INT,
    goods_type_id INT,
    PRIMARY KEY (cart_id, goods_type_id)
);

CREATE TABLE cart (
    cart_id INT PRIMARY KEY,
    total_price DECIMAL(10, 2)
);
```

### 外键约束
```sql
ALTER TABLE buyer
ADD FOREIGN KEY (cart_id) REFERENCES cart(cart_id);

ALTER TABLE security_with_admin
ADD FOREIGN KEY (admin_id) REFERENCES admin(admin_id);

ALTER TABLE security_with_buyer
ADD FOREIGN KEY (buyer_id) REFERENCES buyer(buyer_id);

ALTER TABLE orders
ADD FOREIGN KEY (cart_id) REFERENCES cart(cart_id);

ALTER TABLE admin_view_order
ADD FOREIGN KEY (admin_id) REFERENCES admin(admin_id),
ADD FOREIGN KEY (order_id) REFERENCES order(order_id);

ALTER TABLE info
ADD FOREIGN KEY (buyer_id) REFERENCES buyer(buyer_id);

ALTER TABLE goods_type
ADD FOREIGN KEY (goods_id) REFERENCES goods(goods_id);

ALTER TABLE cart_contain_goods_type
ADD FOREIGN KEY (cart_id) REFERENCES cart(cart_id),
ADD FOREIGN KEY (goods_type_id) REFERENCES goods_type(goods_type_id);
```

### trigger约束
- 添加商品时的价格范围约束和库存约束
```sql
CREATE TRIGGER check_goods_inventory
BEFORE INSERT ON goods_type
FOR EACH ROW
BEGIN
    DECLARE available_inventory INT;
    SELECT goods_inventory INTO available_inventory
    FROM goods
    WHERE goods_id = NEW.goods_id;
    
    IF NEW.price <= 0 OR NEW.price IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Price must be greater than 0.';
    END IF;
    
    IF available_inventory < 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No available inventory for the specified goods.';
    END IF;
    
    SET available_inventory = available_inventory - 1;
    
    UPDATE goods
    SET goods_inventory = available_inventory
    WHERE goods_id = NEW.goods_id;
END;
```

- order形成时清空cart_contain_goods_type中对应cart_id的商品,同时清空cart的total_price
```sql
CREATE TRIGGER clear_cart_and_goods
AFTER INSERT ON orders
FOR EACH ROW
BEGIN
    DELETE FROM cart_contain_goods_type
    WHERE cart_id = NEW.cart_id;
    
    UPDATE cart
    SET total_price = 0
    WHERE cart_id = NEW.cart_id;
END;
```
- 添加cart_contain_goods_type时增加对应的cart中的total_price
```sql
CREATE TRIGGER update_cart_total_price
AFTER INSERT ON cart_contain_goods_type
FOR EACH ROW
BEGIN
    DECLARE goods_price DECIMAL(10, 2);
    SELECT price INTO goods_price
    FROM goods_type
    WHERE goods_type_id = NEW.goods_type_id;
    
    UPDATE cart
    SET total_price = total_price + goods_price
    WHERE cart_id = NEW.cart_id;
END;
```


## 功能设计

### 登录
- 接受一个post请求
- 参数：`username`, `password`, `is_admin`
- 如果`is_admin`为`true`
    - 从`admin`表中取出`admin_name=username`的`admin_id`和`admin_salt`
    - 将`password+admin_salt`进行md5加密得到`secret_password`
    - 检测`secret_password`是否等于`security_with_admin`表中`admin_id=admin_id`的`hash_password`
- 否则同理从`buyer`表取出并同理检测md5是否等于`sercurity+with_buyer`中的`hash_password` 

### 注册
<!-- TODO 暂时不支持管理员注册,以后可以改成管理员邀请注册制功能 -->
- 接受一个post请求
- 参数：`buyer_name`, `password`
- 先检测`buyer_name`是否已存在,如存在返回信息
- 如不存在,根据雪花算法依照时间戳生成`buyer_id`
- 随机生成一个`salt`,将`buyer_id`, `username`, `salt`存入`buyer`表中
- 然后将`password+salt`进行md5加密得到`secret_password`和`buyer_id`存入`security_with_buyer`中

### 商品展示
- 接收 GET 请求参数：`category`（类别）、`keyword`（关键字）、`page`（页码，默认为1）、`limit`（每页显示数量，默认为9）
- 构造查询语句获取总记录数
- 根据请求参数构造查询条件，并将条件添加到查询语句中
- 执行查询获取总记录数
- 计算偏移量,并构造带 LIMIT 和 OFFSET 的查询语句
- 如果存在查询结果：
  - 创建一个空数组 `goods` 存储查询结果
  - 遍历结果集，将每一行数据添加到 `goods` 数组中
  - 构造返回的 JSON 数据，包括 `data`（商品数组）、`page`（当前页码）、`limit`（每页显示数量）、`totalCount`（总记录数
  - 将数组转换为 JSON 字符串
  - 输出 JSON 字符串作为响应
- 如果查询结果为空：
  - 返回一个空数组的 JSON 字符串，包括 `data`（空数组）、`page`（当前页码）、`limit`（每页显示数量）、`totalCount`（总记录数）