package models

import "gorm.io/gorm"

type User struct {
	gorm.Model
	ID         uint `gorm:"primaryKey"`
	Username   string
	Password   string
	Email      string
	Fullname   string
	Properties []Property
}
