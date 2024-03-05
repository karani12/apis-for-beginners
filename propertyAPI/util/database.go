package util

import (
	"gorm.io/driver/sqlite"
	"gorm.io/gorm"
)

func InitializeDB() (*gorm.DB, error) {
	db, err := gorm.Open(sqlite.Open("property.db"), &gorm.Config{})
	if err != nil {
		return nil, err
	}
	return db, nil
}
