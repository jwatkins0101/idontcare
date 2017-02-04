const whois = "http://api.hackertarget.com/whois/?q=";
const loc = "http://ip-api.com/json/";
const plc = "https://www.shodan.io/search?query=%5Cx00+port%3A%2218245%22+country%3A%22US%22+product%3A%22General+Electric+SRTP%22";

var _ = require('underscore');
var express = require('express');
var fs = require('fs');
var request = require('request');
var rp = require('request-promise');
var cheerio = require('cheerio');
var app = express();

var async = require('asyncawait/async');
var await = require('asyncawait/await');
var Promise = require('bluebird');
var local=false;
var protocal = local?"http":"https";


var plccache = null;
//var ips=['166.143.143.154'];
//, '166.151.7.191','173.220.152.146','206.19.236.60','166.142.141.175','166.251.70.183','166.130.117.131','47.21.84.76',
// '166.159.63.47','166.239.205.68','166.255.63.114','166.251.70.56','166.149.195.51','96.57.176.74','162.254.20.24','108.58.169.50',
// '166.166.67.245','166.148.66.128', '50.252.247.34','166.154.156.111','107.84.4.7'];

app.get('/', function (req, res) {
    res.json({ server: "connected" });
});

app.get('/plchash', function (req, res) {
    var hash={};
    plccache.data.forEach((value,index, array)=>{
        hash[value.query]=value;
    })
    res.json(hash);
});

app.get('/plc', function (req, res) {
    if (!local){
        plccache=require('./cache.json');
        res.json(plccache);
    }
    else if (plccache !== null) {
        res.json(plccache);
    } else {
        var ips = [
            '166.143.143.154', '166.151.7.191', '173.220.152.146', '206.19.236.60', '166.142.141.175',
            '166.251.70.183', '166.130.117.131', '47.21.84.76', '166.159.63.47', '166.239.205.68',
            '166.255.63.114', '166.251.70.56', '166.149.195.51', '96.57.176.74', '162.254.20.24',
            '108.58.169.50', '166.166.67.245', '166.148.66.128', '50.252.247.34', '166.154.156.111',
            '107.84.4.7'
            ];

        var fullUrl = protocal + '://' + req.get('host');
        var ip = ips.pop();

        var asyncLoad = async(function () {
            var results = [];
            ips.forEach((ip, index, array) => {
                var myloc = { query: ip };
                await(rp(fullUrl + '/loc?ip=' + ip)
                    .then((html) => {
                        myloc = JSON.parse(html);
                        return rp(fullUrl + '/whois?ip=' + ip);
                    }).then((html) => {
                        var mywhois = JSON.parse(html);
                        var result = _.extend(myloc, mywhois);
                        results.push(result);
                    }).catch((err) => {
                        console.log(err);
                    })
                )
            });
            var extra=require('./data.json');
            results.push(extra);
            return results;
            // if (ips.length>0)
            //     res.json({data:results});
        });
        asyncLoad().then((results) => {
            plccache={ data: results };
            res.json(plccache);
        });
    }

});

app.get('/loc', function (req, res) {
    // The URL we will scrape from - in our example Anchorman 2.

    var ip = req.query.ip;
    console.log(ip);

    // The structure of our request call
    // The first parameter is our URL
    // The callback function takes 3 parameters, an error, response status code and the html

    request(loc + ip, function (error, response, html) {

        // First we'll check to make sure no errors occurred when making the request

        if (!error) {
            // Next, we'll utilize the cheerio library on the returned html which will essentially give us jQuery functionality
            var json = JSON.parse(html);

            res.json(json);
        }
    })
})
app.get('/whois', function (req, res) {
    // The URL we will scrape from - in our example Anchorman 2.

    var ip = req.query.ip;
    console.log(ip);

    // The structure of our request call
    // The first parameter is our URL
    // The callback function takes 3 parameters, an error, response status code and the html

    request(whois + ip, function (error, response, html) {

        // First we'll check to make sure no errors occurred when making the request

        if (!error) {
            // Next, we'll utilize the cheerio library on the returned html which will essentially give us jQuery functionality
            var json = {};
            var lines = html.split(/\r?\n/);
            lines.forEach((value, index, array) => {
                if (value !== "" && !value.startsWith('#')) {
                    var fields = value.split(":");
                    if (fields.length > 1) {
                        json[fields[0].trim()] = fields[1].trim();
                    }
                }
            })
            res.json(json);
        }
    })
})


var port = process.env.PORT || 3000;        // set our port
app.listen(port)
console.log('Magic happens on port' + port);
exports = module.exports = app;