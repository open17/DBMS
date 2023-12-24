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

### 数据库建立

#### 建表与主键约束
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

#### 外键约束
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

#### trigger约束
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


