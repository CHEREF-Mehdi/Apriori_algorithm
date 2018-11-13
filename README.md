# Apriori_algorithm

Apriori [1] is an algorithm for frequent item set mining and association rule learning over transactional databases. It proceeds by identifying the frequent individual items in the database and extending them to larger and larger item sets as long as those item sets appear sufficiently often in the database. The frequent item sets determined by Apriori can be used to determine association rules which highlight general trends in the database: this has applications in domains such as market basket analysis.

# About the solution

The completion date of this project : May 2017

The time of publication in Github : 13 November 2018

You first enter number of trasaction and itemset to create a random data matrix

![alt text](https://github.com/CHEREF-Mehdi/Apriori_algorithm/blob/master/ImageForReadMe/EnterData.PNG)

The data matrix :

![alt text](https://github.com/CHEREF-Mehdi/Apriori_algorithm/blob/master/ImageForReadMe/DataMatrix.PNG)

The liste of the Frequent Itemset :

![alt text](https://github.com/CHEREF-Mehdi/Apriori_algorithm/blob/master/ImageForReadMe/frequentItemset.PNG)

The liste of the rules :

![alt text](https://github.com/CHEREF-Mehdi/Apriori_algorithm/blob/master/ImageForReadMe/Rules.PNG)

# About the source code

The apriori algorithm was implemented using php, you will find it in Pages/PHP/Apriori.class.php

The interface is powered by bootstrap.

# References

[1]: Rakesh Agrawal and Ramakrishnan Srikant "Fast algorithms for mining association rules" (http://www.vldb.org/conf/1994/P487.PDF)
