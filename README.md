# Shift Pro.
This project was built with symfony4 PHP framework.
#
    This is a simple api end point which accepts two parameters total_cost and amount_provided.
    total_cost is the amount incurred on a single transaction, amount_provided is the exact amount paid
#   endpoint
    Sample endpoint is http://switch.test/api/checkout?total_cost=234.34&amount_provided=340.353
    Sample output => {"error":0,"status":201,"balance":"$106.01","change":{"Hundred":1,"Five":1,"One":1,"Penny":1}}
#   Technicality
    This project demonstrates an OOP approach to programing
    It also demonstrates two main advance concepts. TDD Pattern was not used.
      1. Service Oriented Architecture.
      2. Repository pattern.

#   Functionality
    #input Accepts amount provided at input amount_provided(in dolars and/or cents), total cost at param total_cost(in dolars and/or cents)
    #output Returns your change amount in Dolars and cents. Also provides the exact change by returning the count of each denomination of bills and/or coins.

#   PHPUnit Testing
    This project has unit testing implementation.

#  Note
   Returns JSON format.
   This app has the potential of handling more than USA money denomination.
