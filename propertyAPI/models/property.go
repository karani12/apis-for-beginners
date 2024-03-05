package models

import (
	"time"

	"gorm.io/gorm"
)

type Property struct {
	gorm.Model
	ID             uint `gorm:"primaryKey"`
	Name           string
	Description    string
	Location       string
	Type           string
	Image          string
	UserID         uint
	User           User `gorm:"foreignKey:UserID"`
	ApartmentUnits []ApartmentUnit
	CREATED_AT     time.Time
	UPDATED_AT     time.Time
	DELETED_AT     time.Time
}
