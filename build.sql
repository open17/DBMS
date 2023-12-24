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