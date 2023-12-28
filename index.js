const express = require('express');
const path = require('path');
const mongoose=require('mongoose');
const bp = require("body-parser");
const { listenerCount } = require('events');
const Url = "mongodb+srv://praveenmariappan:6yofKQ1XHOxFSjFe@cluster0.drrmffl.mongodb.net/praveen";
mongoose.connect(Url, {
  useNewUrlParser: true,
  useUnifiedTopology: true,
});
const schema = {
    name:String,
    email:String,
    password:String,
    gender:String,
    rating:Number
}
const det = mongoose.model("masters",schema)

const app = express();
app.use(bp.urlencoded({extended:true}))
app.use(express.static(path.join(__dirname, 'public')));
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'index.html'));
});
app.get('/signup.html', (req, res) => {
  res.sendFile(path.join(__dirname, 'signup.html'));
});

app.post('/submit', (req, res) => {
  let details = new det({
    name:req.body.name,
    email:req.body.email,
    password:req.body.password,
    gender:req.body.gender,
  })
  details.save()
  res.redirect("/landing.html")
});

app.get('/login.html', (req, res) => {
  res.sendFile(path.join(__dirname, 'login.html'));
});

app.post('/check', async (req, res) => {
    let mail = req.body.email;
    let pass = req.body.password;
    try {
        const user = await det.findOne({$and: [{email: mail},{password: pass}]});
        if (user) {
          res.redirect('/landing.html');
        } else {
            res.send(`
            <html>
              <body>
                <script>
                  alert('Invalid email or password'); 
                </script>
              </body>
            </html>
          `);

        }
      } catch (error) {
        console.error(error);
        res.status(500).send('Internal Server Error');
      }
    });

    app.get('/login.html', (req, res) => {
      res.sendFile(path.join(__dirname, 'landing.html'));
    });
    let dresstype="";
    let value="";
    app.post('/result', async (req, res) => {
      dresstype = req.body.type;
      value = req.body.color;
      res.redirect('/result');
    });
    app.get('/result', async (req, res) => {
        try {
          const out = await det.find({$and: [{type: dresstype},{source: value}]});
          if (out!==null) {
            let responseHtml = `<!doctype html>
            <html>
                <head>
                    <title>Personalised Wardrobe</title>
                    <!-- CSS only -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
                    <link rel="stylesheet" href="css/signup.css">
                    <link rel="stylesheet" href="css/common.css">
                </head>
                <body>
                    <div class="header mb-5 myBorder">
                        <h1 class="logo">Personalised WARDROBE</h1>
                    </div>
                    <div class="justify">
                        <div class="row pt-5">
                            <div class="col-xs-12 col-md-4 mt-5 mymargintop"> </div>
                            <div class="col-xs-12 col-md-4 mt-5 mymargintop" id="signinform"> 
                                <div class="mt-5">
                                    <div class="myBorder p-5 shadow mb-5">
                                    <h1 class="text-center">Your Matchup</h1>
                                    <ul id="me" class="list-unstyled text-center">`;
      
            let add = "/images/";
            let end = ".jpg";
            let soc=value;
            out.forEach((entry) => {
              responseHtml += `<li><img src="${add}${soc}${entry._doc.dsst}${end}" width="300" height="250"></li>`;
            });
      
            responseHtml += `</ul>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>`;
      
            res.send(responseHtml);
          } else {
            res.send("No matching records found.");
          }
        } catch (error) {
          console.error(error);
          res.status(500).send('Internal Server Error');
        }
      });
      app.get('/rating.html', (req, res) => {
        res.sendFile(path.join(__dirname, 'rating.html'));
      });
      app.post('/rating.html', async (req,res)=>{
        let ratee = req.body.rate;
        let mail = req.body.email;
          try {
              const user = await det.findOne({email: mail});
              const filter = { email : mail };
              const update = { $set: { rating: ratee } };
              if (user) {
                const result = await det.updateOne(filter, update);
                res.redirect('/');
              } else {
                  res.send(`
                  <html>
                    <body>
                      <script>
                        alert('Email not registered for rating'); 
                      </script>
                    </body>
                  </html>
                `);
      
              }
            } catch (error) {
              console.error(error);
              res.status(500).send('Internal Server Error');
            }
       });
                       
    




app.listen(27017, () => {
  console.log('Server is listening on port 27017');
});