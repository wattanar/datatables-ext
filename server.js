const express = require("express");
const cors = require("cors");
const bodyParser = require("body-parser");

const app = express();
app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

app.post("/users", (req, res) => {
  let data = [
    {
      id: 1,
      name: "Leanne Graham",
      username: "Bret",
      email: "Sincere@april.biz",
      phone: "1-770-736-8031 x56442",
      website: "hildegard.org",
    },
  ];

  let dataset = {
    draw: req.body.draw,
    recordsTotal: data.length,
    recordsFiltered: data.length,
    data: data,
  };

  res.json(dataset);
});

app.listen(3000, () => {
  console.log("Listening on port 3000.");
});
