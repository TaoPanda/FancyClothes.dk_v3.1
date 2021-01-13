const express = require("express");
const app = express();
const mysql = require("mysql");
const bodyParser = require("body-parser");

app.use(bodyParser.urlencoded({extended: false}));

const pool = mysql.createPool({
    connectionLimit: 10,
    host: "localhost",
    user: "root",
    database: "fancyclothes.dk"
});

function getMysqlConnection() {
    return pool;
}

app.listen("3000", () => {
    console.log("server is up and listening on 3000...");
})

app.get("/FancyClothes.dk_v3.1/product/:id", (req, res) => {
    console.log("fetching product with id: " + req.params.id);

    const conn = getMysqlConnection();

    const productId = req.params.id;
    const queryString = "SELECT * FROM products WHERE id = ?";
    conn.query(queryString, [productId] , (err, rows, fields)=>{
        if(err){
            console.log("falled to query for products: " + err);
            res.sendStatus(500);
            res.end();
            return;
        }else{
            res.json(rows);
            return;
        }
    })
})

app.get("/FancyClothes.dk_v3.1/products", (req, res) => {
    console.log("fetching products");

    const conn = getMysqlConnection();

    const queryString = "SELECT * FROM products";
    conn.query(queryString,  (err, rows, fields)=>{
        if(err){
            console.log("falled to query for products: " + err);
            res.sendStatus(500);
            res.end();
            return;
        }else{
            res.json(rows);
            return;
        }
    })
})