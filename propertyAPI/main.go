package main

import (
	"github.com/karani12/api-for-beginners/propertyAPI/models"
	"github.com/karani12/api-for-beginners/propertyAPI/util"
)

func main() {
	db, err := util.InitializeDB()
	if err != nil {
		panic(err)
	}

	db.AutoMigrate(&models.Property{}, &models.ApartmentUnit{}, &models.Tenant{}, &models.User{})

}
